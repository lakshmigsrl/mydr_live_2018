<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">
    <?php foreach((array) $this->get('locations') as $location):?>
        <url>
            <loc><?php echo $location['loc']; ?></loc>

            <news:news>
                <news:publication>
                    <news:name>myDr.com.au</news:name>
                    <news:language>en</news:language>
                </news:publication>
                <news:title><?php echo $location['title']; ?></news:title>
                <news:publication_date><?php echo $location['lastmod']; ?></news:publication_date>
            </news:news>
        </url>
    <?php endforeach; ?>
</urlset>