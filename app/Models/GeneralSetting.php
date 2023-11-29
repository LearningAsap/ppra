<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_description',
        'meta_keywords',
        'meta_author',
        'department_full_name',
        'department_short_name',
        'department_description',
        'department_logo',
        'global_phone_no',
        'global_mobile_no',
        'global_address',
        'facebook_link',
        'twitter_link',
        'linked_in_link',
        'youtube_link',
        'google_plus_link',
        'info_email',
        'google_maps_widget',
        'facebook_widget',
        'twitter_widget',
        'cm_cs_image',
        'cm_cs_message_title',
        'cm_cs_message_description',
        'hod_image',
        'hod_message_title',
        'hod_message_description',
        'enabled_what_we_do_panel',
        'enabled_hod_message',
        'enabled_downloads_cm_msg_panel',
        'enabled_top_stories_panel',
        'enabled_fb_twitter_feed_panel',
        'enabled_our_projects_panel',
        'is_enabled_mail',
        'mail_transport',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'rules_reg_short_description',
        'rules_reg_page_content',
        'tender_guidelines_short_description',
        'tender_guidelines_page_content',
        'bidding_documents_short_description',
        'bidding_documents_page_content',
        'tender_instructions_short_description',
        'tender_instructions_page_content',
        'public_procurement_short_description',
        'public_procurement_page_content',
        'standing_instructions_short_description',
        'standing_instructions_page_content',
    ];
}
