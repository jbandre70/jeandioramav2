<?php

declare(strict_types=1);

namespace Jeandiorama;

class JeandioramaAdmin
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', $this->enqueueAdminAssets(...));
        add_action('admin_footer', $this->addElementsToAdmin(...));
    }

    public function enqueueAdminAssets(): void
    {
        $manifestPath = get_theme_file_path('assets/.vite/manifest.json');

        if (file_exists($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true);
            wp_enqueue_script(
                'jeandiorama-admin',
                get_theme_file_uri('assets/' . $manifest['resources/scripts/admin.js']['file'])
            );
            wp_enqueue_style(
                'jeandiorama-admin-css',
                get_theme_file_uri('assets/' . $manifest['resources/scripts/admin.js']['css'][0])
            );
        }
    }

    public function addElementsToAdmin(): void
    {
        echo '<button id="htp-scroll-top"></button>';
    }
}
