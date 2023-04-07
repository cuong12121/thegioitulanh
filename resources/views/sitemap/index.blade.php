<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <sitemap>
        <loc>https://thegioitulanh.com.vn/sitemap_brand.xml</loc>
        <lastmod>{{ Carbon\Carbon::now()->format('Y-m-d') }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>https://thegioitulanh.com.vn/sitemap_pc.xml</loc>
        <lastmod>{{ Carbon\Carbon::now()->format('Y-m-d') }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>https://thegioitulanh.com.vn/sitemap_article.xml</loc>
        <lastmod>{{ Carbon\Carbon::now()->format('Y-m-d') }}</lastmod>
    </sitemap>
</sitemapindex>