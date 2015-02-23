<?php
    /* Social Network Settings */
    $temp = new admin_settingpage('theme_flexibase_social', get_string('socialheading', 'theme_flexibase'));
    $temp->add(new admin_setting_heading('theme_flexibase_social', get_string('socialheadingsub', 'theme_flexibase'),
            format_text(get_string('socialdesc' , 'theme_flexibase'), FORMAT_MARKDOWN)));

    // Website url setting.
    $name = 'theme_flexibase/website';
    $title = get_string('website', 'theme_flexibase');
    $description = get_string('websitedesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Blog url setting.
    $name = 'theme_flexibase/blog';
    $title = get_string('blog', 'theme_flexibase');
    $description = get_string('blogdesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Facebook url setting.
    $name = 'theme_flexibase/facebook';
    $title = get_string(        'facebook', 'theme_flexibase');
    $description = get_string(      'facebookdesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Flickr url setting.
    $name = 'theme_flexibase/flickr';
    $title = get_string('flickr', 'theme_flexibase');
    $description = get_string('flickrdesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Twitter url setting.
    $name = 'theme_flexibase/twitter';
    $title = get_string('twitter', 'theme_flexibase');
    $description = get_string('twitterdesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Google+ url setting.
    $name = 'theme_flexibase/googleplus';
    $title = get_string('googleplus', 'theme_flexibase');
    $description = get_string('googleplusdesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // LinkedIn url setting.
    $name = 'theme_flexibase/linkedin';
    $title = get_string('linkedin', 'theme_flexibase');
    $description = get_string('linkedindesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Tumblr url setting.
    $name = 'theme_flexibase/tumblr';
    $title = get_string('tumblr', 'theme_flexibase');
    $description = get_string('tumblrdesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Pinterest url setting.
    $name = 'theme_flexibase/pinterest';
    $title = get_string('pinterest', 'theme_flexibase');
    $description = get_string('pinterestdesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Instagram url setting.
    $name = 'theme_flexibase/instagram';
    $title = get_string('instagram', 'theme_flexibase');
    $description = get_string('instagramdesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // YouTube url setting.
    $name = 'theme_flexibase/youtube';
    $title = get_string('youtube', 'theme_flexibase');
    $description = get_string('youtubedesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Vimeo url setting.
    $name = 'theme_flexibase/vimeo';
    $title = get_string('vimeo', 'theme_flexibase');
    $description = get_string('vimeodesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // Skype url setting.
    $name = 'theme_flexibase/skype';
    $title = get_string('skype', 'theme_flexibase');
    $description = get_string('skypedesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // General social url setting 1.
    $name = 'theme_flexibase/social1';
    $title = get_string('sociallink', 'theme_flexibase');
    $description = get_string('sociallinkdesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // social icon setting 1.
    $name = 'theme_flexibase/socialicon1';
    $title = get_string('sociallinkicon', 'theme_flexibase');
    $description = get_string('sociallinkicondesc', 'theme_flexibase');
    $default = 'home';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    // General social url setting 2.
    $name = 'theme_flexibase/social2';
    $title = get_string('sociallink', 'theme_flexibase');
    $description = get_string('sociallinkdesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // social icon setting 2.
    $name = 'theme_flexibase/socialicon2';
    $title = get_string('sociallinkicon', 'theme_flexibase');
    $description = get_string('sociallinkicondesc', 'theme_flexibase');
    $default = 'home';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    // General social url setting 3.
    $name = 'theme_flexibase/social3';
    $title = get_string('sociallink', 'theme_flexibase');
    $description = get_string('sociallinkdesc', 'theme_flexibase');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);

    // social icon setting 3.
    $name = 'theme_flexibase/socialicon3';
    $title = get_string('sociallinkicon', 'theme_flexibase');
    $description = get_string('sociallinkicondesc', 'theme_flexibase');
    $default = 'home';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $temp->add($setting);

    $ADMIN->add('theme_flexibase', $temp);