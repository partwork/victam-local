<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'app';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//page navigation non registered user
$route['marketing_info']='app/market_info';
$route['who_Is_Who'] = 'app/who_Is_Who';
$route['resource-library'] = "app/resource_library";
$route['events'] = "app/events";
$route['jobs'] = "app/jobs";
$route['forums'] = "app/forums";
$route['virtual_entertainment'] = "app/virtual_entertainment";
$route['match_making'] = 'app/matchmaking';
$route['active_data'] = 'app/active_data';
$route['deactive_data'] = 'app/deactive_data';
$route['privacy_policy'] = 'e/privacy_policy/load_privacy_policy_view';
$route['manage_account'] = 'e/manage_account/load_manage_account_view';

//oauth navigation
$route['login'] = 'i/LoginController';
$route['register'] = 'i/RegisterController';
$route['profile'] = 'e/ProfileController';
$route['save-profile'] = 'e/ProfileController/';
$route['profile_setting'] = 'e/ProfileController/load_profile_setting';
$route['pricing'] = 'e/PricingController';
$route['subscription'] = 'e/SubscriptionController/load_subscription_View';
$route['cancelSubscription/(:any)'] = 'e/SubscriptionController/cancel_subscription';
$route['delete-account'] = 'e/ManageAccountController';
$route['deleteAccount'] = 'e/ManageAccountController/delete_account';

$route['login_via_google'] = "i/RegisterController/login_via_google";
$route['login_via_facebook'] = "i/RegisterController/login_via_facebook";
$route['logout'] = 'i/LoginController/logout';
$route['forgotPassword'] = 'i/ForgotPasswordController';
$route['reset_password'] = 'i/ResetPasswordController';
$route['reset_password/(:any)/(:any)'] = 'i/ResetPasswordController/load_reset_password_View';

$route['search'] = 'e/SearchController/load_search_view';


$route['who_Is_Who/company-directory'] = 'e/WhoIsWhoController/load_Company_Directory_View';
$route['who_Is_Who/add-company'] = 'e/WhoIsWhoController/load_add_comapny_view';


 
$route['jobs/vacancy'] = "e/JobsController/load_vacancies_view";
$route['jobs/get_job_info_by_id/(:any)'] = "e/JobsController/get_job_info_by_id";

$route['jobs/job-filter'] = "e/JobsController/job_filter_list";
$route['jobs/place-job'] = "e/JobsController/load_place_job_view";
$route['jobs/place-job/(:any)'] = "e/JobsController/load_place_job_view";
$route['jobs/vacancy/(:any)/(:any)/(:any)'] = "e/JobsController/job_filter";
$route['jobs/change_status'] = "e/JobsController/change_status";
$route['jobs/delete_job'] = "e/JobsController/delete_job";

$route['events/online-events'] = "e/EventsController/load_online_events_view";
$route['events/onsite-events'] = "e/EventsController/load_onsite_events_view";
$route['events/video_gallery/(:any)'] = "e/EventsController/load_video_gallery_view";
$route['events/photo_gallery/(:any)'] = "e/EventsController/load_photo_gallery_view";
$route['events/add-event'] = "e/EventsController/load_add_event_view";
$route['events/contact/(:any)'] = "e/EventsController/load_contact_view";
$route['events/calender-event'] = "e/EventsController/load_calender_event_view";
$route['events/calender-event/(:any)'] = "e/EventsController/load_calender_event_view";
$route['events/calender-event/(:any)/(:any)'] = "e/EventsController/load_calender_event_view";
$route['events/calender-event/(:any)/(:any)/(:any)'] = "e/EventsController/load_calender_event_view";
$route['events/event-details/(:any)'] = "e/EventsController/load_event_details_view";
$route['events/get_events_date'] = "e/EventsController/get_events_date";
$route['events/conclusion_report/(:any)'] = "e/EventsController/load_conclusion_report_view";
$route['events/logo_ads_banner/(:any)'] = "e/EventsController/load_logo_ads_banner_view";
$route['events/geteventby_date'] = "e/EventsController/geteventby_date";
$route['events-filter'] = "e/EventsController/events_filter";
$route['events/update_registration_count'] = "e/EventsController/update_registration_count";


$route['matchmaking/find_buyers'] = "e/MatchmakingController/load_buyers_view";
$route['matchmaking/find_suppliers'] = "e/MatchmakingController/load_suppliers_view";
$route['matchmaking/suppliers_list'] = "e/MatchmakingController/load_suppliers_list_view";
$route['matchmaking/buyers_list'] = "e/MatchmakingController/load_buyers_list_view";
$route['matchmaking/find_new_buyers'] = 'e/MatchmakingController/find_new_buyers';

//Resources and Library
$route['resource-library/research-innovation'] = "e/ResourceLibraryController/load_research_innovation_view";
$route['resource-library/add-innovation'] = "e/ResourceLibraryController/load_add_innovation_view";
$route['resource-library/case-studies'] = "e/ResourceLibraryController/load_case_studies_view";
$route['resource-library/add-casestudy'] = "e/ResourceLibraryController/load_add_casestudy_view";
$route['resource-library/white-paper'] = "e/ResourceLibraryController/load_white_paper_view";
$route['resource-library/add-white-paper'] = "e/ResourceLibraryController/load_add_white_paper_view";
$route['resource-library/publication'] = "e/ResourceLibraryController/load_publication_view";
$route['resource-library/add-publication'] = "e/ResourceLibraryController/load_add_publication_view";
$route['store_resource']="e/ResourceLibraryController/store_study";
$route['search_resource']="e/ResourceLibraryController/search_using_keywords";
$route['store_source_contact']="e/ResourceLibraryController/add_source_contact";
$route['show_source_doc/(:any)']="e/ResourceLibraryController/show_document/$1";
$route['default_resource_list']="e/ResourceLibraryController/getDefaultList";
$route['source_download/(:any)']="e/Pdf_download/download_file/$1";


//Marketing Info
$route['mrk_sarch_data']="e/MarketingInformationController/search_blog_news"; 
$route['news']='e/MarketingInformationController/news';
$route['news/(:any)']='e/MarketingInformationController/news/$1';
$route['interview']='e/MarketingInformationController/interview';
$route['articles']='e/MarketingInformationController/articles';
$route['news_readmore/(:any)']='e/MarketingInformationController/readmore/$1';
$route['marketing_info/(:any)']='e/MarketingInformationController/new_sector/$1';

//Forums
$route['forums/new-forum'] = "e/ForumsController/load_new_forum_View";
$route['store_forum']='e/ForumsController/add_forum';
$route['like_event']='e/ForumsController/like_event';
$route['res_like_event']='e/ForumsController/res_like_event';
$route['send_comment']='e/ForumsController/store_comment';
$route['load_comments']='e/ForumsController/load_morecomment';
$route['search_forums']='e/ForumsController/search_forums';


$route['matchmaking'] = "e/MatchmakingController/load_matchmaking_view";
$route['matchmaking/find_buyers'] = "e/MatchmakingController/load_buyers_view";
$route['matchmaking/find_suppliers'] = "e/MatchmakingController/load_suppliers_view";
$route['matchmaking/suppliers_list'] = "e/MatchmakingController/load_suppliers_list_view";
$route['matchmaking/buyers_list'] = "e/MatchmakingController/load_buyers_list_view";
$route['matchmaking/find_new_suppliers'] = 'e/MatchmakingController/find_new_suppliers';
$route['matchmaking/get_buyers_list/(:any)/(:any)/(:any)/(:any)'] = 'e/MatchmakingController/get_buyers_list';
$route['matchmaking/get_buyers_list'] = 'e/MatchmakingController/get_buyers_list';
$route['matchmaking/get_buyers_list_all'] = 'e/MatchmakingController/get_buyers_list';
$route['matchmaking/get_buyers_list_by_search/(:any)'] = 'e/MatchmakingController/get_buyers_list_by_search';
$route['matchmaking/get_company_details/(:any)'] = 'e/MatchmakingController/get_company_details';
$route['matchmaking/filter_buyers_list'] = 'e/MatchmakingController/filter_buyer_list';

$route['video_gallery'] = 'e/VirtualEntertainmentController/load_video_gallery_View';

//pricing
$route['payment'] = 'e/PricingController/paymentSucess';

//write for us
$route['write-for-us'] = 'e/WriteforusController';



//admin routes user management
$route['admin'] = 'admin/welcomepage/WelcomeController';
$route['changePassword'] = 'admin/change_password/ChangePasswordController';
$route['resetPassword'] = 'admin/reset_password/ResetPasswordController';
$route['admin/manage-user'] = 'admin/usermanagement/ManageUserController';
$route['admin/manage-user/add-user'] = 'admin/usermanagement/ManageUserController/addEditUser';
$route['admin/user_edit_page/(:any)'] = 'admin/usermanagement/ManageUserController/addEditUser/$1';
$route['admin/add_user'] = 'admin/usermanagement/ManageUserController/add_user/';
$route['admin/user_delete'] = 'admin/usermanagement/ManageUserController/delete_user/';
$route['admin/user_changestatus'] = 'admin/usermanagement/ManageUserController/status_update/';
$route['admin/user_search'] = 'admin/usermanagement/ManageUserController/search_data/';
$route['admin/get_user_list_json'] = 'admin/usermanagement/ManageUserController/fetch_user/';

$route['admin/resetpassword'] = 'admin/change_password/ChangePasswordController/reset_password';


//admin content management
$route['admin/content-management/home/latest-news'] = 'admin/contentmanagement/HomeController/latestNews';
$route['admin/content-management/home/latest-news/add-latest-news'] = 'admin/contentmanagement/HomeController/addEditLatestNews';
$route['admin/content-management/home/latest-news/get-latest-news/(:any)'] = 'admin/contentmanagement/HomeController/get_latest_news_by_id';
$route['admin/content-management/home/latest-news/delete-latest-news/(:any)'] = 'admin/contentmanagement/HomeController/delete_interview_article_news/$1';
$route['admin/content-management/home/latest-news/reject_interview_article_news/(:any)'] = 'admin/contentmanagement/HomeController/reject_interview_article_news/$1';
$route['admin/content-management/home/latest-news/add_new_news'] = 'admin/contentmanagement/HomeController/add_new_news';
$route['admin/content-management/home/latest-news/update_latest_news'] = 'admin/contentmanagement/HomeController/update_latest_news';
$route['admin/content-management/home/latest-news/update-status/(:any)/(:any)'] = 'admin/contentmanagement/HomeController/update_status_inverview/$1/$2';	
$route['admin/content-management/home/promoted_video/update-status/(:any)/(:any)'] = 'admin/contentmanagement/HomeController/update_status_promoted_vid/$1/$2';	
$route['admin/get_latestnews_list_json'] = 'admin/contentmanagement/HomeController/latestNews_json_list';




$route['admin/content-management/home/latest-interview'] = 'admin/contentmanagement/HomeController/latestInterview';
$route['admin/content-management/home/latest-interview/pagination/(:any)'] = 'admin/contentmanagement/HomeController/latestInterview';
$route['admin/content-management/home/latest-interview/add-latest-interview'] = 'admin/contentmanagement/HomeController/addEditLatestInterview';
$route['admin/content-management/home/latest-news/get-latest-interview/(:any)'] = 'admin/contentmanagement/HomeController/get_interview_by_id';
$route['admin/content-management/home/latest-news/add_interviews'] = 'admin/contentmanagement/HomeController/add_interviews';
$route['admin/content-management/home/latest-news/edit_interviews'] = 'admin/contentmanagement/HomeController/update_latest_interview';
$route['admin/content-management/home/latest-interview/pagination'] = 'admin/contentmanagement/HomeController/latestInterview';


$route['admin/content-management/home/banners'] = 'admin/contentmanagement/HomeController/banner';
$route['admin/content-management/home/banners/add-banner'] = 'admin/contentmanagement/HomeController/addEditbanner';
$route['admin/content-management/home/banners/pagination/(:any)'] = 'admin/contentmanagement/HomeController/banner';
$route['admin/content-management/home/banners/pagination'] = 'admin/contentmanagement/HomeController/banner';
$route['admin/content-management/home/banners/update_banner'] = 'admin/contentmanagement/HomeController/update_banner';
$route['admin/content-management/home/banners/add_banner'] = 'admin/contentmanagement/HomeController/add_banner';
$route['admin/content-management/home/banners/edit_banner'] = 'admin/contentmanagement/HomeController/update_banner';
$route['admin/content-management/home/banners/delete_banner/(:any)'] = 'admin/contentmanagement/HomeController/delete_banner_logo';
$route['admin/content-management/home/banners/get_banner_by_id/(:any)'] = 'admin/contentmanagement/HomeController/get_banner_by_id';
$route['admin/content-management/home/banners/reject_logo_banner/(:any)'] = 'admin/contentmanagement/HomeController/reject_logo_banner';
$route['admin/content-management/home/banners/update-status/(:any)/(:any)'] = 'admin/contentmanagement/HomeController/update_status_banner/$1/$2';
$route['admin/banner_search'] = 'admin/contentmanagement/HomeController/search_list';

$route['admin/content-management/home/logos'] = 'admin/contentmanagement/HomeController/logos';
$route['admin/content-management/home/logos/add-logos'] = 'admin/contentmanagement/HomeController/addEditlogos';
$route['admin/content-management/home/logos/pagination/(:any)'] = 'admin/contentmanagement/HomeController/logos';
$route['admin/content-management/home/logos/pagination'] = 'admin/contentmanagement/HomeController/logos';
$route['admin/content-management/home/banners/update_logo'] = 'admin/contentmanagement/HomeController/update_logos';
$route['admin/content-management/home/banners/add_logo'] = 'admin/contentmanagement/HomeController/add_logos';
$route['admin/content-management/home/banners/edit_logo'] = 'admin/contentmanagement/HomeController/update_logos';
$route['admin/content-management/home/banners/delete_logo/(:any)'] = 'admin/contentmanagement/HomeController/delete_banner_logo';
$route['admin/content-management/home/logos/get_logo_by_id/(:any)'] = 'admin/contentmanagement/HomeController/get_logos_by_id';


$route['admin/content-management/home/promoted-videos'] = 'admin/contentmanagement/HomeController/promotedVideos';
$route['admin/content-management/home/promoted-videos/pagination/(:any)'] = 'admin/contentmanagement/HomeController/promotedVideos';
$route['admin/content-management/home/promoted-videos/pagination'] = 'admin/contentmanagement/HomeController/promotedVideos';
$route['admin/content-management/home/promoted-videos/add-promoted-video'] = 'admin/contentmanagement/HomeController/addEditPromotedVideos';
$route['admin/content-management/home/promoted-videos/add-video'] = 'admin/contentmanagement/HomeController/publish_save_promoted_video';
$route['admin/content-management/home/promoted-videos/update_promoted_video'] = 'admin/contentmanagement/HomeController/update_promoted_video';
$route['admin/promoted_video/delete_promoted/(:any)'] = 'admin/contentmanagement/HomeController/delete_promoted/$1';

$route['admin/content-management/home/advertisement'] = 'admin/contentmanagement/HomeController/advertisements';
$route['admin/content-management/home/advertisement/pagination/(:any)'] = 'admin/contentmanagement/HomeController/advertisements';
$route['admin/content-management/home/advertisement/pagination'] = 'admin/contentmanagement/HomeController/advertisements';
$route['admin/content-management/home/advertisement/add-advertisement'] = 'admin/contentmanagement/HomeController/addEditAdvertisements';
$route['admin/get_advert_jsonlist'] = 'admin/contentmanagement/HomeController/get_advertjson_list';
$route['admin/promoted_video_search'] = 'admin/contentmanagement/HomeController/search_list';
$route['admin/edit_promoted_video/(:any)'] = 'admin/contentmanagement/HomeController/addEditPromotedVideos/$1';
$route['admin/status_promoted_video/(:any)/(:any)'] = 'admin/contentmanagement/HomeController/change_status_promoted/$1/$2';
$route['admin/reject_promoted'] = 'admin/contentmanagement/HomeController/reject_promoted_video';

$route['admin/content-management/home/advertisement/add_advertisement'] = 'admin/contentmanagement/HomeController/publish_save_advertisement';
$route['admin/content-management/home/advertisement/edit_advertisement'] = 'admin/contentmanagement/HomeController/update_advertisment';
$route['admin/content-management/home/advertisement/delete_advertisement/(:any)'] = 'admin/contentmanagement/HomeController/delete_advertisement_by_id';
$route['admin/content-management/home/advertisement/get-advertisement-news/(:any)'] = 'admin/contentmanagement/HomeController/get_advertisement_by_id';
$route['admin/content-management/home/advertisement/status_advertisement/(:any)/(:any)'] = 'admin/contentmanagement/HomeController/change_status_adv/$1/$2';
$route['admin/latest_interview_search_list'] = 'admin/contentmanagement/HomeController/search_list';
$route['admin/advertsement_video_search'] = 'admin/contentmanagement/HomeController/search_list';
$route['admin/adv_video_search'] = 'admin/contentmanagement/HomeController/search_list';
$route['admin/get_adv_book_position'] = 'admin/contentmanagement/HomeController/get_adv_position';
$route['admin/reject_advertisement/(:any)'] = 'admin/contentmanagement/HomeController/reject_advertisement/$1';



//admin marketing info

$route['admin/content-management/market-info/news'] = 'admin/contentmanagement/MarketInformationController/news';
$route['admin/content-management/market-info/add-news'] = 'admin/contentmanagement/MarketInformationController/addNews';
$route['admin/content-management/home/market-info/get-latest-news/(:any)'] = 'admin/contentmanagement/MarketInformationController/get_latest_news_by_id';
$route['admin/get_mktnews_list_json'] = 'admin/contentmanagement/MarketInformationController/get_json_list';

$route['admin/content-management/market-info/interviews'] = 'admin/contentmanagement/MarketInformationController/interviews';
$route['admin/content-management/market-info/interviews/pagination'] = 'admin/contentmanagement/MarketInformationController/interviews';
$route['admin/content-management/market-info/interviews/pagination/(:any)'] = 'admin/contentmanagement/MarketInformationController/interviews';
$route['admin/content-management/market-info/add-interviews'] = 'admin/contentmanagement/MarketInformationController/addInterviews';
$route['admin/content-management/market-info/articles'] = 'admin/contentmanagement/MarketInformationController/articles';
$route['admin/content-management/market-info/add-articles'] = 'admin/contentmanagement/MarketInformationController/addArticles';
$route['admin/content-management/market-info/magazines'] = 'admin/contentmanagement/MarketInformationController/magazines';
$route['admin/content-management/market-info/magazines/pagination/(:any)'] = 'admin/contentmanagement/MarketInformationController/magazines';
$route['admin/content-management/market-info/magazines/pagination'] = 'admin/contentmanagement/MarketInformationController/magazines';
$route['admin/content-management/market-info/add-magazines'] = 'admin/contentmanagement/MarketInformationController/addMagazines';
$route['admin/add_marketing_info'] = 'admin/contentmanagement/MarketInformationController/store_marketing_info';
$route['admin/reject_marketing_info/(:any)'] = 'admin/contentmanagement/MarketInformationController/reject_data/$1';
$route['admin/edit_marketing_info/(:any)'] = 'admin/contentmanagement/MarketInformationController/edit_marketing_info/$1';
$route['admin/delete_mkt_info/(:any)'] = 'admin/contentmanagement/MarketInformationController/delete_mkt_info/$1';
$route['admin/add_magzine'] = 'admin/contentmanagement/MarketInformationController/add_magzine';
$route['admin/edit_marketing_status/(:any)/(:any)'] = 'admin/contentmanagement/MarketInformationController/edit_marketing_status/$1/$2';
$route['admin/search_marketing_data'] = 'admin/contentmanagement/MarketInformationController/search_data_ajax';
// Admin Who Is Who
$route['admin/content-management/who-is-who/whoIsWho'] = 'admin/contentmanagement/WhoIsWhoController/whoIsWho';
$route['admin/content-management/who-is-who/whoIsWho/pagination/(:any)'] = 'admin/contentmanagement/WhoIsWhoController/whoIsWho';
$route['admin/content-management/who-is-who/whoIsWho/pagination'] = 'admin/contentmanagement/WhoIsWhoController/whoIsWho';
$route['admin/content-management/who-is-who/addCompany'] = 'admin/contentmanagement/WhoIsWhoController/addCompany';
$route['admin/content-management/who-is-who/delete_by_id/:(any)'] = 'admin/contentmanagement/WhoIsWhoController/delete_company_by_id';
$route['admin/content-management/whoiswho/get_company_by_id/:(any)'] = 'admin/contentmanagement/WhoIsWhoController/get_company_details_by_ids';
$route['admin/upda-company'] = 'admin/contentmanagement/WhoIsWhoController/update_company';
$route['admin/delete_whoiswho'] = 'admin/contentmanagement/WhoIsWhoController/delete_company';
$route['admin/change_status_whoiswho'] = 'admin/contentmanagement/WhoIsWhoController/change_status_whoiswho';
$route['admin/who_video_search'] = 'admin/contentmanagement/WhoIsWhoController/search_whoiswho';
$route['admin/reject_whoiswho/(:any)'] = 'admin/contentmanagement/WhoIsWhoController/reject_whoiswho/$1';

// Admin Resource Library
$route['admin/content-management/resource-library/researchInnovations'] = 'admin/contentmanagement/ResourceLibraryController/researchInnovations';
$route['admin/content-management/resource-library/addresearchInnovations'] = 'admin/contentmanagement/ResourceLibraryController/addresearchInnovations';
$route['admin/content-management/resource-library/caseStudies'] = 'admin/contentmanagement/ResourceLibraryController/caseStudies';
$route['admin/content-management/resource-library/addcaseStudies'] = 'admin/contentmanagement/ResourceLibraryController/addcaseStudies';
$route['admin/content-management/resource-library/whitePaper'] = 'admin/contentmanagement/ResourceLibraryController/whitePaper';
$route['admin/content-management/resource-library/addWhitePaper'] = 'admin/contentmanagement/ResourceLibraryController/addWhitePaper';
$route['admin/content-management/resource-library/publications'] = 'admin/contentmanagement/ResourceLibraryController/publications';
$route['admin/content-management/resource-library/addPublications'] = 'admin/contentmanagement/ResourceLibraryController/addPublications';
$route['admin/add_resourcelib'] = 'admin/contentmanagement/ResourceLibraryController/add_resourcelib';
$route['admin/edit/resource-library/(:any)'] = 'admin/contentmanagement/ResourceLibraryController/addresearchInnovations/$1';
$route['admin/delete_resourcelib/(:any)'] = 'admin/contentmanagement/ResourceLibraryController/delete_resourcelib/$1';
$route['admin/reject_resource/(:any)'] = 'admin/contentmanagement/ResourceLibraryController/rejectResourcelib/$1';
$route['admin/get_resource_jsonlist'] = 'admin/contentmanagement/ResourceLibraryController/get_json_list';


// Admin Events
$route['admin/contentmanagement/events/events'] = 'admin/contentmanagement/EventsController/events';
$route['admin/contentmanagement/events/addEvents'] = 'admin/contentmanagement/EventsController/addEvents';
$route['admin/add_new_events'] = 'admin/contentmanagement/EventsController/add_event';
$route['admin/editEvents/(:any)'] = 'admin/contentmanagement/EventsController/edit_events/$1';
$route['admin/delete_event'] = 'admin/contentmanagement/EventsController/delete_events';
$route['admin/reject_event/(:any)'] = 'admin/contentmanagement/EventsController/reject_data/$1';
$route['admin/get_events_jsonlist'] = 'admin/contentmanagement/EventsController/get_json_list';

// Admin Forums
$route['admin/content-management/forums/forums'] = 'admin/contentmanagement/ForumsController/forums';
$route['admin/content-management/forums/addForums'] = 'admin/contentmanagement/ForumsController/addForums';
$route['admin/add_forums'] = 'admin/contentmanagement/ForumsController/storeForum';
$route['admin/edit_forums/(:any)'] = 'admin/contentmanagement/ForumsController/edit_forums/$1';
$route['admin/delete_forum/(:any)'] = 'admin/contentmanagement/ForumsController/delete_forums/$1';
$route['admin/reject_forum/(:any)'] = 'admin/contentmanagement/ForumsController/reject_forums/$1';
$route['admin/get_forum_jsonlist'] = 'admin/contentmanagement/ForumsController/get_json_list';

// Admin Virtual Entertainment
$route['admin/content-management/virtual-entertainment/video'] = 'admin/contentmanagement/VirtualEntertainmentController/video';
$route['admin/content-management/virtual-entertainment/addVideo'] = 'admin/contentmanagement/VirtualEntertainmentController/addVideo';
$route['admin/add_videos'] = 'admin/contentmanagement/VirtualEntertainmentController/storeVideo';
$route['admin/edit_videos/(:any)'] = 'admin/contentmanagement/VirtualEntertainmentController/edit_video/$1';
$route['admin/reject_video/(:any)'] = 'admin/contentmanagement/VirtualEntertainmentController/reject_video/$1';
$route['admin/change_status_video'] = 'admin/contentmanagement/VirtualEntertainmentController/change_status';
$route['admin/delete_video'] = 'admin/contentmanagement/VirtualEntertainmentController/delete_video';
$route['admin/virtual_json_list'] = 'admin/contentmanagement/VirtualEntertainmentController/json_list';
$route['admin/virtual_search_list'] = 'admin/contentmanagement/VirtualEntertainmentController/search_list';
$route['admin/content-management/virtual-entertainment/video/pagination/(:any)'] = 'admin/contentmanagement/VirtualEntertainmentController/video';



$route['pay/process'] = 'pay/Pay_controller/process';


$route['search'] = 'e/searchcontroller';
$route['search/ajax_request_by_value/(:any)'] = 'e/searchcontroller/ajax_request_by_value';

$route['mail/welcome'] = 'e/EmailController/welcomemail';
$route['mail/otp'] = 'e/EmailController/otpmail';


$route['notification/get_count'] = 'admin/others/NotificationController/get_unread_count';
$route['notification/get_notification'] = 'admin/others/NotificationController/get_notification';

$route['privacy-policy'] = 'e/PrivacyPolicyController';


//share via facebook