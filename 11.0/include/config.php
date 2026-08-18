<?php
###############################
## ResourceSpace
## Local Configuration Script
###############################

# All custom settings should be entered in this file.
# Options may be copied from config.default.php and configured here.

# MySQL database settings
$mysql_server = 'localhost';
$mysql_username = 'newuser2';
$mysql_password = 'password';
$mysql_db = 'resource';

$mysql_bin_path = '/usr/bin';

# Base URL of the installation
$baseurl = 'http://89.127.235.30';

# Email settings
$email_notify = 'admin@admin.com';
$email_from = 'admin@admin.com';
# Secure keys
$scramble_key = 'bc74896eeca7743a56fb036e548d8cbdc8730ae4d702dd9f28bed77fb9238a56';
$api_scramble_key = '8ec6da0a7acfc0f4bb0c625f50b2e18e0e137da3436547a756653a949b975af1';

# Paths
$ghostscript_path = '/usr/bin';
$applicationname = 'ResourceSpace';
$defaultlanguage = 'es';
$homeanim_folder = 'filestore/system/slideshow_b73dfaf47366983';

/*

New Installation Defaults
-------------------------

The following configuration options are set for new installations only.
This provides a mechanism for enabling new features for new installations without affecting existing installations (as would occur with changes to config.default.php)

*/
                                
// Set imagemagick default for new installs to expect the newer version with the sRGB bug fixed.
$imagemagick_colorspace = "sRGB";

$contact_link=false;

$stemming=true;
$case_insensitive_username=true;
$user_pref_user_management_notifications=true;

$use_zip_extension=true;
$collection_download=true;

$ffmpeg_preview_force = true;
$ffmpeg_preview_extension = 'mp4';
$ffmpeg_preview_options = '-f mp4 -b:v 1200k -b:a 64k -ac 1 -c:v libx264 -pix_fmt yuv420p -profile:v baseline -level 3 -c:a aac -strict -2';

$daterange_search = true;
$upload_then_edit = true;

$purge_temp_folder_age=90;
$filestore_evenspread=true;

$comments_resource_enable=true;

$api_upload_urls = array();

$use_native_input_for_date_field = true;
$resource_view_use_pre = true;

$sort_tabs = false;
$maxyear_extends_current = 5;
$thumbs_display_archive_state = true;
$file_checksums = true;
$hide_real_filepath = true;
$annotate_enabled = true;

$plugins[] = "brand_guidelines";

$imagemagick_path = '/usr/bin';
$exiftool_path = '/usr/bin';
$ffmpeg_path = '/usr/bin';