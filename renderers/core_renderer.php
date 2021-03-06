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
 * Theme Flexibase renderer file.
 *
 * @package    theme_flexibase
 * @author     2015 Richard Oelmann
 * @copyright  2015 R. Oelmann
 * @parents    Bootstrap
 * @copyright  2014 Bas Brands
 * @credits    flexibase - Julian Ridden, Gareth Barnard;
 *             Elegance - Julian Ridden, Danny Wahl;
 *             BCU - Jez H, Mike Grant
 *             Many others for non-specific but vital inspirations,
 *             suggestions and support
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_flexibase
 * @copyright  2015
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->dirroot.'/blocks/course_overview/locallib.php');
require_once($CFG->dirroot . "/course/renderer.php");
require_once($CFG->libdir. '/coursecatlib.php');

class theme_flexibase_core_renderer extends core_renderer {

    public function edit_button(moodle_url $url) {
        $url->param('sesskey', sesskey());
        if ($this->page->user_is_editing()) {
            $url->param('edit', 'off');
            $btn = 'btn-danger';
            $title = get_string('turneditingoff');
            $icon = 'fa-power-off';
        } else {
            $url->param('edit', 'on');
            $btn = 'btn-success';
            $title = get_string('turneditingon');
            $icon = 'fa-edit';
        }
        return html_writer::tag('a', html_writer::start_tag('i', array('class' => $icon . ' fa fa-fw')) .
            html_writer::end_tag('i') . $title, array('href' => $url, 'class' => 'btn ' . $btn, 'title' => $title));
    }

    public function notification($message, $classes = 'notifyproblem') {
        $message = clean_text($message);

        if ($classes == 'notifyproblem') {
            return html_writer::div($message, 'alert alert-danger');
        }
        if ($classes == 'notifywarning') {
            return html_writer::div($message, 'alert alert-warning');
        }
        if ($classes == 'notifysuccess') {
            return html_writer::div($message, 'alert alert-success');
        }
        if ($classes == 'notifymessage') {
            return html_writer::div($message, 'alert alert-info');
        }
        if ($classes == 'redirectmessage') {
            return html_writer::div($message, 'alert alert-block alert-info');
        }
        if ($classes == 'notifytiny') {
            // Not an appropriate semantic alert class!
            return $this->debug_listing($message);
        }
        return html_writer::div($message, $classes);
    }

    private function debug_listing($message) {
        $message = str_replace('<ul style', '<ul class="list-unstyled" style', $message);
        return html_writer::tag('pre', $message, array('class' => 'alert alert-info'));
    }

    public function navbar() {
        $items = $this->page->navbar->get_items();
        if (empty($items)) { // MDL-46107
            return '';
        }
        $breadcrumbs = '';
        foreach ($items as $item) {
            $item->hideicon = true;
            $breadcrumbs .= '<li>'.$this->render($item).'</li>';
        }
        return "<ol class=breadcrumb>$breadcrumbs</ol>";
    }

    public function custom_menu($custommenuitems = '') {
        // The custom menu is always shown, even if no menu items
        // are configured in the global theme settings page.
        global $CFG;

        if (empty($custommenuitems) && !empty($CFG->custommenuitems)) { // MDL-45507
            $custommenuitems = $CFG->custommenuitems;
        }
        $custommenu = new custom_menu($custommenuitems, current_language());
        return $this->render_custom_menu($custommenu);
    }

    protected function render_custom_menu(custom_menu $menu) {
        global $CFG, $PAGE, $OUTPUT, $COURSE;

        if (isloggedin() && !isguestuser()) {

            $mycoursetitle = "Calendar";
            $branchtitle = "Calendar";
            $branchlabel = '<i class="fa fa-calendar"></i> '.$branchtitle;
            $branchurl   = new moodle_url('/calendar/view.php');
            $branchsort  = -9998;
            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);

            $mycoursetitle = "My Courses";
            $branchtitle = "My Courses";
            $branchlabel = '<i class="fa fa-briefcase"></i>&nbsp;<span class="menutitle">'.$branchtitle.'</span>';
            $branchurl   = new moodle_url('/my/index.php');
            $branchsort  = -9999;

            $branch = $menu->add($branchlabel, $branchurl, $branchtitle, $branchsort);

            $branchtitle = get_string('myhome');
            $branchlabel = '<i class="fa fa-dashboard"></i> '.$branchtitle;
            $branchurl   = new moodle_url('/my/index.php');
            $branchsort  = -9996;
            $branch->add($branchlabel, $branchurl, $branchtitle, $branchsort);

            list($sortedcourses, $sitecourses, $totalcourses) = block_course_overview_get_sorted_courses();

            if ($sortedcourses) {
                foreach ($sortedcourses as $course) {
                    if ($course->visible) {
                        $branch->add(format_string($course->fullname), new moodle_url('/course/view.php?id='.$course->id), format_string($course->shortname));
                    }
                }
            } else {
                $noenrolments = get_string('noenrolments', 'theme_flexibase');
                $branch->add('<em>'.$noenrolments.'</em>', new moodle_url('/'), $noenrolments);
            }

            if (ISSET($COURSE->id) && $COURSE->id > 1) {
                $branchtitle = get_string('thiscourse', 'theme_flexibase');
                $branchlabel = '<i class="fa fa-sitemap"></i>&nbsp;<span class="menutitle">'.$branchtitle.'</span>';
                $branchurl = new moodle_url('#');
                $branch = $menu->add($branchlabel, $branchurl, $branchtitle, -9995);

                $branchtitle = "People";
                $branchlabel = $OUTPUT->pix_icon('i/group', '', '', array('class' => 'icon')).$branchtitle;
                $branchurl = new moodle_url('/user/index.php', array('id' => $PAGE->course->id));
                $branch->add($branchlabel, $branchurl, $branchtitle, -9994);

                $branchtitle = "Grades";
                $branchlabel = $OUTPUT->pix_icon('i/grades', '', '', array('class' => 'icon')).$branchtitle;
                $branchurl = new moodle_url('/grade/report/index.php', array('id' => $PAGE->course->id));
                $branch->add($branchlabel, $branchurl, $branchtitle, -9993);

                $data = theme_flexibase_get_course_activities();

                foreach ($data as $modname => $modfullname) {
                    if ($modname === 'resources') {
                        $icon = $OUTPUT->pix_icon('icon', '', 'mod_page', array('class' => 'icon'));
                        $branch->add($icon.$modfullname, new moodle_url('/course/resources.php', array('id' => $PAGE->course->id)));
                    } else {
                        $icon = '<img src="'.$OUTPUT->pix_url('icon', $modname) . '" class="icon" alt="" />';
                        $branch->add($icon.$modfullname, new moodle_url('/mod/'.$modname.'/index.php', array('id' => $PAGE->course->id)));
                    }
                }
            }

        }
        // TODO: eliminate this duplicated logic, it belongs in core, not
        // here. See MDL-39565.

        $content = '<ul class="nav navbar-nav">';
        foreach ($menu->get_children() as $item) {
            $content .= $this->render_custom_menu_item($item, 1);
        }

        return $content.'</ul>';
    }

    public function flexibase_user_menu($user = NULL, $withlinks = NULL) {
        global $CFG;
        $usermenu = new custom_menu('', current_language());
        return $this->flexibase_render_user_menu($usermenu);
    }

    protected function flexibase_render_user_menu(custom_menu $menu) {
        global $CFG, $USER, $DB;

        $addusermenu = true;
        $addlangmenu = true;

        $langs = get_string_manager()->get_list_of_translations();
        if (count($langs) < 2
        or empty($CFG->langmenu)
        or ($this->page->course != SITEID and !empty($this->page->course->lang))) {
            $addlangmenu = false;
        }

        if ($addlangmenu) {
            $language = $menu->add(get_string('language'), new moodle_url('#'), get_string('language'), 10000);
            foreach ($langs as $langtype => $langname) {
                $language->add($langname, new moodle_url($this->page->url, array('lang' => $langtype)), $langname);
            }
        }

        if ($addusermenu) {
            if (isloggedin()) {
                $course = $this->page->course;
                $context = context_course::instance($course->id);
                $userpic = parent::user_picture($USER, array('link' => false));
                $usermenu = $menu->add(fullname($USER), new moodle_url('#'), fullname($USER), 10001);
                // RO Added based on flexibase
                if (\core\session\manager::is_loggedinas()) {
                    $realuser = \core\session\manager::get_realuser();
                    $usermenu->add(
                        '<em><i class="fa fa-key"> </i>' .' '. fullname($realuser, true) . get_string('loggedinas', 'theme_flexibase') . fullname($USER, true) . '</em>',
                        new moodle_url('/user/profile.php', array('id' => $USER->id)),
                        get_string('loggedinas', 'theme_flexibase')
                    );
                } else {
                    $usermenu->add(
                        '<em><i class="fa fa-user"> </i>' .' '. fullname($USER, true) . '</em>',
                        new moodle_url('/user/profile.php', array('id' => $USER->id)),
                        fullname($USER, true)
                    );
                }
                if (is_mnet_remote_user($USER) && $idprovider = $DB->get_record('mnet_host', array('id' => $USER->mnethostid))) {
                    $usermenu->add(
                        '<em><i class="fa fa-users"></i>' .' '. get_string('loggedinfrom', 'theme_flexibase') . $idprovider->name . '</em>',
                        new moodle_url($idprovider->wwwroot),
                        get_string('loggedinfrom', 'theme_flexibase')
                    );
                }
                if (is_role_switched($course->id)) { // Has switched roles
                    $usermenu->add(
                        '<em><i class="fa fa-users"></i>' .' '. get_string('switchrolereturn') . '</em>',
                        new moodle_url('/course/switchrole.php', array('id' => $course->id, 'sesskey' => sesskey(), 'switchrole' => 0, 'returnurl' => $this->page->url->out_as_local_url(false))),
                        get_string('switchrolereturn')
                    );
                }
                $usermenu->add('<hr class="sep">');

                if (has_capability('moodle/user:editownprofile', $context)) {
                    $usermenu->add(
                        '<em><i class="fa fa-user"></i>' .' '. get_string('editmyprofile') . '</em>',
                        new moodle_url('/user/edit.php', array('id' => $USER->id)),
                        get_string('editmyprofile')
                    );
                }
                if (has_capability('moodle/user:changeownpassword', $context)) {
                    $usermenu->add(
                        '<em><i class="fa fa-key"></i>' .' '. get_string('changepassword') . '</em>',
                        new moodle_url('/login/change_password.php'),
                        get_string('changepassword')
                    );
                }
                if (has_capability('moodle/user:editownmessageprofile', $context)) {
                    $usermenu->add(
                        '<em><i class="fa fa-comments"></i>' .' '. get_string('messagepreferences', 'theme_flexibase') . '</em>',
                        new moodle_url('/message/edit.php', array('id' => $USER->id)),
                        get_string('messagepreferences', 'theme_flexibase')
                    );
                }
                if ($CFG->enableblogs) {
                    $usermenu->add(
                        '<em><i class="fa fa-rss-square"></i>' .' '. get_string('blogpreferences', 'theme_flexibase') . '</em>',
                        new moodle_url('/blog/preferences.php'),
                        get_string('blogpreferences', 'theme_flexibase')
                    );
                }
                if ($CFG->enablebadges && has_capability('moodle/badges:manageownbadges', $context)) {
                    $usermenu->add(
                        '<em><i class="fa fa-certificate"></i>' .' '. get_string('badgepreferences', 'theme_flexibase') . '</em>',
                        new moodle_url('/badges/preferences.php'),
                        get_string('badgepreferences', 'theme_flexibase')
                    );
                }

                $usermenu->add('<hr class="sep">');
                // Check if messaging is enabled.
                if (!empty($CFG->messaging)) {
                    $usermenu->add(
                        '<em><i class="fa fa-envelope"></i>' .' '. get_string('pluginname', 'block_messages') . '</em>',
                        new moodle_url('/message/index.php'),
                        get_string('pluginname', 'block_messages')
                    );
                }
                // Check if user is allowed to manage files
                if (has_capability('moodle/user:manageownfiles', $context)) {
                    $usermenu->add(
                        '<em><i class="fa fa-file"></i>' .' '. get_string('privatefiles', 'block_private_files') . '</em>',
                        new moodle_url('/user/files.php'),
                        get_string('privatefiles', 'block_private_files')
                    );
                }
                // Check if user is allowed to view discussions
                if (has_capability('mod/forum:viewdiscussion', $context)) {
                    $usermenu->add(
                        '<em><i class="fa fa-list-alt"></i>' .' '. get_string('forumposts', 'mod_forum') . '</em>',
                        new moodle_url('/mod/forum/user.php', array('id' => $USER->id)),
                        get_string('forumposts', 'mod_forum')
                    );
                    $usermenu->add(
                        '<em><i class="fa fa-list"></i>' .' '. get_string('discussions', 'mod_forum') . '</em>',
                        new moodle_url('/mod/forum/user.php', array('id' => $USER->id, 'mode' => 'discussions')),
                        get_string('discussions', 'mod_forum')
                    );
                }
                $usermenu->add('<hr class="sep">');
                // Output user grade links course sensitive, workaround for frontpage, selecting first enrolled course
                if ($course->id == 1) {
                    $hascourses = enrol_get_my_courses(NULL, 'visible DESC,id ASC', 1);
                    foreach ($hascourses as $hascourse) {
                        $reportcontext = context_course::instance($hascourse->id);
                        if (has_capability('gradereport/user:view', $reportcontext) && $hascourse->visible) {
                            $usermenu->add(
                                '<em><i class="fa fa-list-alt"></i>' .' '. get_string('mygrades', 'theme_flexibase') . '</em>',
                                new moodle_url('/grade/report/overview/index.php' , array('id' => $hascourse->id, 'userid' => $USER->id)),
                                get_string('mygrades', 'theme_flexibase')
                            );
                        }
                    }
                } else if (has_capability('gradereport/user:view', $context)) {
                            $usermenu->add(
                                '<em><i class="fa fa-list-alt"></i>' .' '. get_string('mygrades', 'theme_flexibase') . '</em>',
                                new moodle_url('/grade/report/overview/index.php' , array('id' => $course->id, 'userid' => $USER->id)),
                                get_string('mygrades', 'theme_flexibase')
                            );
                            $usermenu->add(
                                '<em><i class="fa fa-list-alt"></i>' .' '. get_string('coursegrades', 'theme_flexibase') . '</em>',
                                new moodle_url('/grade/report/user/index.php' , array('id' => $course->id, 'userid' => $USER->id)),
                                get_string('coursegrades', 'theme_flexibase')
                            );

                }
                // Check if badges are enabled.
                if (!empty($CFG->enablebadges) && has_capability('moodle/badges:manageownbadges', $context)) {
                    $usermenu->add(
                        '<em><i class="fa fa-certificate"></i>' .' '. get_string('badges') . '</em>',
                        new moodle_url('/badges/mybadges.php'),
                        get_string('badges')
                    );
                }
                $usermenu->add('<hr class="sep">');
                // Render direct logout link
                    $usermenu->add(
                        '<em><i class="fa fa-sign-out"></i>' .' '. get_string('logout') . '</em>',
                        new moodle_url('/login/logout.php?sesskey=' . sesskey()),
                        get_string('logout')
                    );

            } else {
                $usermenu = $menu->add(get_string('login'), new moodle_url('/login/index.php'), get_string('login'), 10001);
            }
        }

        $content = '<ul class="nav navbar-nav navbar-right">';
                foreach ($menu->get_children() as $item) {
                    $content .= $this->render_custom_menu_item($item, 1);
                }
        return $content.'</ul>';
    }

    protected function render_custom_menu_item(custom_menu_item $menunode, $level = 0 ) {
        static $submenucount = 0;

        if ($menunode->has_children()) {

            if ($level == 1) {
                $dropdowntype = 'dropdown';
            } else {
                $dropdowntype = 'dropdown-submenu';
            }

            $content = html_writer::start_tag('li', array('class' => $dropdowntype));
            // If the child has menus render it as a sub menu.
            $submenucount++;
            if ($menunode->get_url() !== null) {
                $url = $menunode->get_url();
            } else {
                $url = '#cm_submenu_'.$submenucount;
            }
            $linkattributes = array(
                'href' => $url,
                'class' => 'dropdown-toggle',
                'data-toggle' => 'dropdown',
                'title' => $menunode->get_title(),
            );
            $content .= html_writer::start_tag('a', $linkattributes);
            $content .= $menunode->get_text();
            if ($level == 1) {
                $content .= '<b class="caret"></b>';
            }
            $content .= '</a>';
            $content .= '<ul class="dropdown-menu">';
            foreach ($menunode->get_children() as $menunode) {
                $content .= $this->render_custom_menu_item($menunode, 0);
            }
            $content .= '</ul>';
        } else {
            $content = '<li>';
            // The node doesn't have children so produce a final menuitem.
            if ($menunode->get_url() !== null) {
                $url = $menunode->get_url();
            } else {
                $url = '#';
            }
            $content .= html_writer::link($url, $menunode->get_text(), array('title' => $menunode->get_title()));
        }
        return $content;
    }

    protected function render_tabtree(tabtree $tabtree) {
        if (empty($tabtree->subtree)) {
            return '';
        }
        $firstrow = $secondrow = '';
        foreach ($tabtree->subtree as $tab) {
            $firstrow .= $this->render($tab);
            if (($tab->selected || $tab->activated) && !empty($tab->subtree) && $tab->subtree !== array()) {
                $secondrow = $this->tabtree($tab->subtree);
            }
        }
        return html_writer::tag('ul', $firstrow, array('class' => 'nav nav-tabs nav-justified')) . $secondrow;
    }

    protected function render_tabobject(tabobject $tab) {
        if ($tab->selected or $tab->activated) {
            return html_writer::tag('li', html_writer::tag('a', $tab->text), array('class' => 'active'));
        } else if ($tab->inactive) {
            return html_writer::tag('li', html_writer::tag('a', $tab->text), array('class' => 'disabled'));
        } else {
            if (!($tab->link instanceof moodle_url)) {
                // Backward compatibility when link was passed as quoted string.
                $link = "<a href=\"$tab->link\" title=\"$tab->title\">$tab->text</a>";
            } else {
                $link = html_writer::link($tab->link, $tab->text, array('title' => $tab->title));
            }
            return html_writer::tag('li', $link);
        }
    }

    public function box($contents, $classes = 'generalbox', $id = null, $attributes = array()) {
        if (isset($attributes['data-rel']) && $attributes['data-rel'] === 'fatalerror') {
            return html_writer::div($contents, 'alert alert-danger', $attributes);
        }
        return parent::box($contents, $classes, $id, $attributes);
    }

}
