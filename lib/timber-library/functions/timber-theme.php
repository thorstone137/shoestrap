<?php

class TimberTheme extends TimberCore
{

    public $name;
    public $slug;
    public $path;
    public $uri;
    public $link;
    public $parent_slug;
    public $parent;

    /**
     * @param string $slug
     */
    function __construct($slug = null) {
        $this->init($slug);
    }

    /**
     * @param string $slug
     */
    function init($slug = null) {
        $data = wp_get_theme($slug);
        $this->name = $data->get('Name');
        $ss = $data->get_stylesheet();
        $this->slug = $ss;
        $this->path = WP_CONTENT_SUBDIR . str_replace(WP_CONTENT_DIR, '', get_stylesheet_directory());
        $this->uri = get_stylesheet_directory_uri();
        $this->link = $this->uri;
        $this->parent_slug = $data->get('Template');
        if (!$this->parent_slug) {
            $this->path = WP_CONTENT_SUBDIR . str_replace(WP_CONTENT_DIR, '', get_template_directory());
            $this->uri = get_template_directory_uri();
        }
        if ($this->parent_slug && $this->parent_slug != $this->slug) {
            $this->parent = new TimberTheme($this->parent_slug);
        }
    }

    /**
     * @param string $name
     * @param bool $default
     * @return string
     */
    public function theme_mod($name, $default = false) {
        return get_theme_mod($name, $default);
    }

    /**
     * @return string
     */
    public function theme_mods() {
        return get_theme_mods();
    }

}
