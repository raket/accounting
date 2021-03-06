<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace ledgr\accounting;

use ledgr\accounting\Exception\OutOfBoundsException;

/**
 * Manage a collection of templates
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class ChartOfTemplates
{
    /**
     * @var array List of loaded templates
     */
    private $templates = array();

    /**
     * Add template
     *
     * If multiple templates with the same id are added the former is
     * overwritten
     *
     * @param  Template $template
     * @return void
     */
    public function addTemplate(Template $template)
    {
        $id = $template->getId();
        $this->templates[$id] = $template;
    }

    /**
     * Drop template using id
     *
     * @param  string $id
     * @return void
     */
    public function dropTemplate($id)
    {
        assert('is_string($id)');
        unset($this->templates[$id]);
    }

    /**
     * Check if template exists
     *
     * @param  string $id
     * @return bool
     */
    public function exists($id)
    {
        assert('is_string($id)');
        return isset($this->templates[$id]);
    }

    /**
     * Get a template clone using id
     *
     * @param  string               $id
     * @return Template
     * @throws OutOfBoundsException If template does not exist
     */
    public function getTemplate($id)
    {
        assert('is_string($id)');
        if (!$this->exists($id)) {
            throw new OutOfBoundsException("Template <$id> does not exist");
        }
        return clone $this->templates[$id];
    }

    /**
     * Get loaded tempaltes
     *
     * @return array Template ids as keys
     */
    public function getTemplates()
    {
        return $this->templates;
    }
}
