<?php

namespace App\Http\Controllers\Sitemap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\Wpisy;

class SitemapController extends Controller
{
    public function generate()
    {
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        // Dodaj statyczne ścieżki
        $staticRoutes = [
            '/cookies' => 'monthly',
            '/nasza-oferta' => 'monthly',
            '/portfolio' => 'monthly',
            '/o-naszej-firmie' => 'monthly',
            '/strefa-klienta' => 'monthly',
            '/rezerwacje-slub' => 'monthly',
            '/rezerwacje-imprez' => 'monthly',
            '/rezerwacje-biznesowe' => 'monthly',
            '/kontakt' => 'monthly',
            '/blog' => 'monthly',
            '/polityka-prywatnosci' => 'monthly',
            '/rejestracja' => 'monthly',
            '/logowanie' => 'monthly',
            '/odzyskiwanie-hasla' => 'monthly',
        ];

        foreach ($staticRoutes as $path => $changefreq) {
            $this->addUrl($xml, 'http://szambo-na-lata.pl' . $path, '2023-10-10T00:00:00+00:00', $changefreq, 0.8);
        }

        // Pobierz dynamiczne wpisy z modelu Wpisy
        $entries = Wpisy::all();

        // Dodaj dynamiczne strony na podstawie danych z modelu Wpisy (na końcu sitemapu)
        foreach ($entries as $entry) {
            $url = 'http://szambo-na-lata.pl/artykul/' . $entry->nazwa;
            $lastmod = $entry->updated_at->toIso8601String();
            $this->addUrl($xml, $url, $lastmod, 'weekly', 0.6);
        }

        $xml->endElement();
        $xmlContent = $xml->outputMemory();

        return response($xmlContent)->header('Content-Type', 'text/xml');
    }

    private function addUrl(\XMLWriter $xml, $loc, $lastmod, $changefreq, $priority)
    {
        $xml->startElement('url');
        $xml->writeElement('loc', $loc);
        $xml->writeElement('lastmod', $lastmod);
        $xml->writeElement('changefreq', $changefreq);
        $xml->writeElement('priority', $priority);
        $xml->endElement();
    }
}
