<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('meta_author')->nullable();
            $table->string('department_full_name');
            $table->string('department_short_name')->nullable();
            $table->text('department_description')->nullable();
            $table->string('department_logo');
            $table->string('global_phone_no')->nullable();
            $table->string('global_mobile_no')->nullable();
            $table->string('global_address')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('linked_in_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('google_plus_link')->nullable();
            $table->string('info_email')->nullable();
            $table->text('google_maps_widget')->nullable();
            $table->text('facebook_widget')->nullable();
            $table->text('twitter_widget')->nullable();
            $table->string('cm_cs_image')->nullable();
            $table->string('cm_cs_message_title')->nullable();
            $table->text('cm_cs_message_description')->nullable();
            $table->string('hod_image')->nullable();
            $table->string('hod_message_title')->nullable();
            $table->text('hod_message_description')->nullable();
            $table->boolean('enabled_what_we_do_panel')->default(1);
            $table->boolean('enabled_hod_message')->default(1);
            $table->boolean('enabled_downloads_cm_msg_panel')->default(1);
            $table->boolean('enabled_top_stories_panel')->default(1);
            $table->boolean('enabled_fb_twitter_feed_panel')->default(1);
            $table->boolean('enabled_our_projects_panel')->default(1);
            $table->boolean('is_enabled_mail')->default(0);
            $table->string('mail_transport')->nullable();
            $table->string('mail_host')->nullable();
            $table->integer('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->text('rules_reg_short_description')->nullable();
            $table->text('rules_reg_page_content')->nullable();
            $table->text('tender_guidelines_short_description')->nullable();
            $table->text('tender_guidelines_page_content')->nullable();
            $table->text('bidding_documents_short_description')->nullable();
            $table->text('bidding_documents_page_content')->nullable();
            $table->text('tender_instructions_short_description')->nullable();
            $table->text('tender_instructions_page_content')->nullable();
            $table->text('public_procurement_short_description')->nullable();
            $table->text('public_procurement_page_content')->nullable();
            $table->text('standing_instructions_short_description')->nullable();
            $table->text('standing_instructions_page_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
};
