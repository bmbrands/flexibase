<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme Flexibase renderers file.
 * Link to individual renderer files for easier organisation
 *
 * @package    theme_flexibase
 * @author     2015 Richard Oelmann
 * @copyright  2015 R. Oelmann
 * @parents    Bootstrap
 * @copyright  2014 Bas Brands
 * @credits    Essential - Julian Ridden, Gareth Barnard;
 *             Elegance - Julian Ridden, Danny Wahl;
 *             BCU - Jez H, Mike Grant
 *             Many others for non-specific but vital inspirations,
 *             suggestions and support
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once('renderers/core_renderer.php');
require_once('renderers/maintenance_renderer.php');
require_once('renderers/admin_renderer.php');
require_once('renderers/course_renderer.php');
require_once('renderers/course_format_renderer.php');
require_once('renderers/course_management.php');
require_once('renderers/files_renderer.php');
require_once('renderers/enrol_renderer.php');
require_once('renderers/navigation_block_renderer.php');
