<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\AutoConfirEmailController;
use App\Http\Controllers\QuickReportController;
use App\Http\Controllers\MessageDispatchController;
use App\Http\Controllers\RegionalUserManagementController;
use App\Http\Controllers\PublicSubscriberController;
use App\Http\Controllers\ClosureReportsController;
use App\Http\Controllers\StationRecipiant;
use App\Http\Controllers\FAToolsController;
use App\Http\Controllers\NewsMediaMonitoringController;
use App\Http\Controllers\NewsReleaseController;
use App\Http\Controllers\MessengerSubscriptionController;
use App\Http\Controllers\MonitoringReportController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\FTInfoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//--------------------------------------frontend----------------------------------------------
Route::get('/', [RegionController::class,'MenuSection']);
Route::get('/regions/{regionName}', [RegionController::class,'OrgCat'])->name('regions');
Route::post('/getorgName', [RegionController::class,'searchByOrgName'])->name("search.ByOrg");
Route::post('/getorgData', [RegionController::class,'orgList']);
Route::get('/id/{org}', [MessengerSubscriptionController::class,'EmergencyMess']);
Route::get('messenger-login',[MessengerSubscriptionController::class,'loginme'])->name('messengersub.login');
Route::match(['get', 'post'],'regions',[MessengerSubscriptionController::class,'frontend_region'])->name('frontend-region');
Route::get('/ids/{org}', [MessengerSubscriptionController::class,'EmergencyMess1']);
Route::get('messenger-login',[MessengerSubscriptionController::class,'loginme'])->name('messengersub.login')->middleware('alreadyLoggedIN')->middleware('prevent-back-history');
Route::match(array('GET','POST'),'/signup', [MessengerSubscriptionController::class, 'subscribe'])->name('messSubscribe');
Route::match(array('GET','POST'),'/create', [MessengerSubscriptionController::class, 'msmanage'])->name('messSubscribeManage');
Route::middleware(['subuser'])->group(function () {
    Route::match(array('GET','POST'),'/manage', [MessengerSubscriptionController::class,'subdashboard'])->name('sub-dashboard');
    Route::match(array('GET','POST'),'/validatecode', [MessengerSubscriptionController::class,'validatecode'])->name('validatecode');
    Route::match(array('GET','POST'),'/adduseremail', [MessengerSubscriptionController::class,'adduseremail'])->name('adduseremail');
    Route::match(array('GET','POST'),'/deleteemail/{id}', [MessengerSubscriptionController::class,'deleteemail']);
    Route::match(array('GET','POST'),'/resendcode/{id}', [MessengerSubscriptionController::class,'resendcode']);
    Route::match(array('GET','POST'),'/showorganization', [MessengerSubscriptionController::class,'showorganization'])->name('showorganization');
    Route::match(array('GET','POST'),'/showorganizationbyserch', [MessengerSubscriptionController::class,'showorganizationbyserch'])->name('showorganizationbyserch');
    Route::match(array('GET','POST'),'/addsubscription', [MessengerSubscriptionController::class,'addsubscription'])->name('addsubscription');
    Route::match(array('GET','POST'),'/updatenewssubs', [MessengerSubscriptionController::class,'updatenewssubs'])->name('updatenewssubs');
    Route::get('/deletesubscription/{id}', [MessengerSubscriptionController::class,'deletesubscription']);
    Route::match(array('GET','POST'),'/changePasswrd', [MessengerSubscriptionController::class,'changePasswrd'])->name('changePasswrd');
    Route::get('/deletesubscriptionaccount/{id}', [MessengerSubscriptionController::class,'deletesubscriptionaccount']);
    Route::get('/sendtest/{id}', [MessengerSubscriptionController::class,'sendtest']);

    

    
    

    
    });
Route::get('/msgsublogout', [MessengerSubscriptionController::class,'logout'])->name('msgsublogout');
Route::get('user-login-link/{token}/{email}', [MessengerSubscriptionController::class, 'UserLoginLinkValidate']);
Route::post('sub-login', [MessengerSubscriptionController::class, 'mesSubLogin'])->name('mesSubLogin');
Route::get('forgetPass',[MessengerSubscriptionController::class,'lostpass'])->name('frontend-lostpass');
Route::get('/post-your-news/{url}/{id}', [RegionController::class,'postnews'])->name('postnewsregions');
Route::get('/user-login', [CommonController::class,'ulogin'])->name('userlogin');
Route::post('/submit-form', [RegionController::class,'submitForm']);
Route::get('/for-news-media', [CommonController::class,'forNewsMedia'])->name('newsmedia');
Route::get('/file-types', [CommonController::class,'fileTypes']);
Route::get('/about', [CommonController::class,'aboutus'])->name('about');
Route::get('/policies', [CommonController::class,'policy']);
Route::post('/email-link', [CommonController::class,'emaillink'])->name('email.link');
Route::get('login-link/{token}', [CommonController::class, 'LoginLinkValidate']);
Route::get('guide.html',[CommonController::class,'guideForPostingNews'])->name('closure.guide');
Route::get('flashblog',[CommonController::class,'flashblog'])->name('blog');
Route::get('monitor',[NewsMediaMonitoringController::class,'newsMediaMonitor'])->name('monitor');
Route::get('attach-app-tutor',[MessengerSubscriptionController::class,'attach_app'])->name('attach-app-tut');

// Route::get('/tutorial.pdf', function () {
//     $file = Storage::disk('local')->path('pdffile/tutorial.pdf');
//     return response()->file($file, ['Content-Type' => 'application/pdf']);
// })->name('tutorial.pdf');
Route::get('sampletext.htm',[CommonController::class,'sampletxt'])->name('sampletext');
Route::get('MonitoringReport.html',[MonitoringReportController::class,'monitorReport'])->name('monitoring.Report');
Route::match(array('GET','POST'),'participants.html',[ParticipantsController::class,'participantslist'])->name('participants.list');
Route::get('fees.html',[ParticipantsController::class,'feestructure'])->name('feestructure.list');
// Route::match(array('GET','POST'),'fees.html',[ParticipantsController::class,'feestructure'])->name('feestructure.list');

//this is for info.html route for include files//
Route::get('info.html',[FTInfoController::class,'ftinfo'])->name('flashalert.info');
// Route::match(array('GET','POST'),'info.html',[FTInfoController::class,'ftinfo'])->name('flashalert.info');
Route::get('proxy-content', [FTInfoController::class,'proxyContent']);
Route::get('infoleft', [FTInfoController::class, 'infoleft'])->name('infoleft');
Route::get('inforight', [FTInfoController::class, 'inforight'])->name('inforight');
Route::get('IIN/reportsX/cwc-closures', [FTInfoController::class, 'reportcwcReport'])->name('report-cwc-Report');
//this is for info.html route for include files//



Route::get('uc',[CommonController::class,'underconst'])->name('underconstruction');

// add user
Route::get('IIN/addnewuser', [QuickReportController::class,'addnewuser'])->name("add.newuser");
Route::get('IIN/addnewuserp', [QuickReportController::class,'getnewuserregion'])->name("post.newuser");
Route::post('IIN/getnewuserregion', [QuickReportController::class,'addnewuserdata'])->name("add.newuserdata");
Route::post('IIN/showuserdata', [QuickReportController::class,'showuserdata'])->name("show.userdata");
Route::post('IIN/insertuserdata', [QuickReportController::class,'insertuserdata'])->name("insert.userdata");
Route::get('IIN/signupmessage', [QuickReportController::class,'signupmessage'])->name("signup.message");
//New user

//----------------------Not create page yet
// Route::get('/Sponsered-Content', [CommonController::class,'SponseredContent']);
// Route::get('/signin/?signin=cookies', [CommonController::class,'messengerSubscription']);
//----------------------Not create page yet
//--------------------------------------frontend----------------------------------------------

//--------------------------------------Backend----------------------------------------------
Route::prefix('IIN')->group(function () {
    Route::get('optimize', function () {
        Artisan::call('optimize:clear');
        Artisan::call('route:clear');
        Artisan::call('cache:clear ');
        Artisan::call('config:clear');
        return "Optimization cleared!";
    });
    Route::get('login', [UserController::class,'login'])->name('backend.signin')->middleware('alreadyLoggedIN')->middleware('prevent-back-history');
    Route::get('onetimelogin', [UserController::class,'onetimelogin'])->name("onetime.login");
    Route::get('getorgdata', [UserController::class,'getorgdata'])->name("getogron");
    Route::get('orgcategory', [UserController::class,'orgcategory'])->name("orgcategory");
    Route::post('sendlogindetail', [UserController::class,'sendlogindetail'])->name("sendlogindetail");

    Route::post('custom-login', [UserController::class, 'customLogin'])->name('login')->middleware(['throttle:loginattempt']);
    Route::middleware(['isLoggedIN', 'prevent-back-history'])->group(function () {
        Route::get('dashboard', [UserController::class,'admindashboard'])->name('backend.dashboard');
        Route::get('/logout', [UserController::class,'logout'])->name('logout');
        Route::get('failed-login', [UserController::class,'failedlogin'])->name('f.login');
        Route::get('del-failed-login/{id}', [UserController::class,'delfailedlogin']);
        Route::post('/delete-selected', [UserController::class,'deleteSelected'])->name('delete.selected');
        
        //--------------------------Add New User----------------------------------------//
        //Route::get('addnewuser', [UserController::class,'addnewuser'])->name("add.newuser");
       // Route::post('addnewuser', [UserController::class,'getnewuserregion'])->name("post.newuser");
        //Route::post('getnewuserregion', [UserController::class,'addnewuserdata'])->name("add.newuserdata");
        // Route::get('addnewuser', [QuickReportController::class,'addnewuser'])->name("add.newuser");
        // Route::get('addnewuserp', [QuickReportController::class,'getnewuserregion'])->name("post.newuser");
        // Route::post('getnewuserregion', [QuickReportController::class,'addnewuserdata'])->name("add.newuserdata");
        // Route::post('showuserdata', [QuickReportController::class,'showuserdata'])->name("show.userdata");
        // Route::post('insertuserdata', [QuickReportController::class,'insertuserdata'])->name("insert.userdata");
        // Route::get('signupmessage', [QuickReportController::class,'signupmessage'])->name("signup.message");
        //--------------------------Add New User----------------------------------------//

        //--------------------------Quick SignUp Option-----------------------------//
        Route::get('quicksignup', [UserController::class,'quicksignup'])->name("quick.signup");
        Route::post('/getorgcat', [UserController::class,'getquickcat'])->name("quick.orgcat");
        Route::post('getquicksignup', [UserController::class,'getquicksignup'])->name("get.quicksignup");
        //--------------------------Quick SignUp Option-----------------------------//

        //--------------------------User/Org Management-----------------------------//
        Route::match(array('GET','POST'),'usrorgmngmt', [RegionalUserManagementController::class, 'usrorgmngmt'])->name('userorgmngmnt');
        Route::get('getOrgCategories/{regionId}', [RegionalUserManagementController::class, 'getOrgCategories'])->name('get.orgcat');
        Route::get('orginform/{id}', [RegionalUserManagementController::class, 'usrorg_inform'])->name('org-inform');
        Route::get('orginformsub/{id}', [RegionalUserManagementController::class, 'usrorg_inform_sub']);



        Route::get('buninesspartner/{id}', [RegionalUserManagementController::class, 'buninesspartner']);
        Route::get('editbuninesspartner/{id}', [RegionalUserManagementController::class, 'editbuninesspartner']);
        Route::get('deletebusinesspartner/{id}', [RegionalUserManagementController::class, 'deletebusinesspartner']);
        Route::post('insertbusinesspartner/', [RegionalUserManagementController::class, 'insertbusinesspartner'])->name('insert.business.partner');
        Route::post('createcsv/', [RegionalUserManagementController::class, 'createcsv'])->name('createcsv');
        Route::get('static/sample.csv/', [RegionalUserManagementController::class, 'staticsamplecsv']);
        Route::post('/importcreatecsv', [RegionalUserManagementController::class, 'importCSV'])->name('importcreatecsv');
        Route::get('addgrouppartner/{id}', [RegionalUserManagementController::class, 'addgrouppartner']);
        Route::get('editgrouppartner/{id}', [RegionalUserManagementController::class, 'editgrouppartner']);
        Route::get('deletegrouppartner/{id}', [RegionalUserManagementController::class, 'deletegrouppartner']);
        Route::post('insertgrouppartner/', [RegionalUserManagementController::class, 'insertgrouppartner'])->name('insert.group.partner');


        Route::get('adnwsuborg', [RegionalUserManagementController::class, 'addSubOrg'])->name('suborg-adnwsuborg');
        Route::get('delorg/{id}', [RegionalUserManagementController::class, 'delorg']);
        Route::post('addgroup', [RegionalUserManagementController::class, 'addgroup'])->name('add.group');
        Route::post('editorgdata', [RegionalUserManagementController::class, 'editorgdata'])->name('edit.org.data');
        Route::post('editsuborgdata', [RegionalUserManagementController::class, 'editsuborgdata'])->name('edit.suborg.data');
        Route::post('defaultdispatch', [RegionalUserManagementController::class, 'defaultdispatch'])->name('default.dispatch');


        //--------------------------User/Org Management-----------------------------//

        //--------------------------Region-----------------------------------------//
        Route::get('region-data', [RegionController::class,'regiondata'])->name('region.data');
        Route::post('/add-region', [RegionController::class,'addregion'])->name('add.region');
        Route::get('/delete-region/{id}', [RegionController::class,'deleteregion']);
        Route::get('/edit-region/{id}', [RegionController::class,'editregion']);
        //--------------------------Region---------------------------------------//

        //--------------------------City---------------------------------------//
        Route::post('/add-city', [RegionController::class,'addcity'])->name('add.city');
        Route::get('city',[RegionController::class,'city'])->name('city.data');
        Route::get('delete-city/{id}', [RegionController::class,'deletecity']);
        Route::get('edit-city/{id}', [RegionController::class,'editcity']);
        //--------------------------City---------------------------------------//

        //--------------------------Org---------------------------------------//
        Route::post('/add-org', [RegionController::class,'addorg'])->name('add.org');
        Route::get('org',[RegionController::class,'org'])->name('org.data');
        Route::get('delete-org/{id}', [RegionController::class,'deleteorg']);
        Route::get('edit-org/{id}', [RegionController::class,'editorg']);
        Route::post('get-org/', [RegionController::class,'getorg'])->name('get.org');
        Route::get('delete-org/', [RegionController::class,'deleteorg'])->name("d.org");
        Route::post('/orgoptions/{id}/increase-rank', [RegionController::class,'increaseRank'])->name('orgoptions.increase-rank');
        Route::post('/orgoptions/{id}/decrease-rank', [RegionController::class,'decreaseRank'])->name('orgoptions.decrease-rank');
        //--------------------------Org---------------------------------------//


       //----------------------Quick Report OptionCity-----------------------//
        Route::get('QReport',[QuickReportController::class,'QuickReportOption'])->name('QReport');
        Route::post('add_QReport', [QuickReportController::class,'storeQReport'])->name('form.add_QReport');
        Route::get('edit-QReport', [QuickReportController::class,'editQReport']);
        Route::post('/qroptions/{id}/increase-rank', [QuickReportController::class,'increaseRank'])->name('qroptions.increase-rank');
        Route::post('/qroptions/{id}/decrease-rank', [QuickReportController::class,'decreaseRank'])->name('qroptions.decrease-rank');
        Route::get('delete-QR', [QuickReportController::class,'deleteQR'])->name("d.QROption");
        //----------------------Quick Report OptionCity-----------------------//

        //-------------------------Message Dispatch--------------------------//
        Route::match(array('GET','POST'),'message-dispatch', [MessageDispatchController::class,'msgdispatch'])->name("msg.dispatch");
        Route::get('get-dispatch-cat', [MessageDispatchController::class,'getquickcatmsg'])->name("get.quickcatmsg");
        Route::post('mailall', [MessageDispatchController::class,'mailall'])->name("mail.all");
        //-------------------------Message Dispatch--------------------------//

        //---------------------------Public Subscriber-----------------------//
        Route::match(array('GET','POST'),'sublist',[PublicSubscriberController::class,'SubscriberList'])->name('psub_list');
        Route::get('sublist-{id}',[PublicSubscriberController::class,'SubscriberEmailList'])->name('psub_Emaillist');
        Route::get('unsubscribe-all/{id}', [PublicSubscriberController::class, 'unsubscribeAll']);
        Route::get('psubCReport',[PublicSubscriberController::class,'PSubCR'])->name('psub_subCR');
        Route::get('punsublist',[PublicSubscriberController::class,'PunsubList'])->name('p_unsublist');
        Route::match(['GET', 'POST'], 'purgSub', [PublicSubscriberController::class, 'purgeSubs'])->name('purg_subs');
        Route::get('emailchangetl',[PublicSubscriberController::class,'changeEmailT'])->name('email.changeTool');
                //“Purge All Unvalidated emails” and “Purge All Accounts with Invalid primary email address”
        Route::post('purge/unvalidated', [PublicSubscriberController::class,'purgeUnvalidated'])->name('purge.unvalidated');
        Route::post('purge/invalidPrimaryEmails', [PublicSubscriberController::class,'purgeInvalidPrimaryEmails'])->name('purge.invalidPrimaryEmails');
               //“Purge All Unvalidated emails” and “Purge All Accounts with Invalid primary email address”

        //---------------------------Public Subscriber-----------------------//

        //---------------------------Regional Administration-----------------------//
        Route::match(array('GET','POST'),'closurereports',[ClosureReportsController::class,'closurereports'])->name('closure.reports');
        Route::get('closuresendmessage-{orgId}',[ClosureReportsController::class,'closuresendmess'])->name('closure.message');
        Route::post('sendclosuresmess', [ClosureReportsController::class,'sendclosuresmess'])->name("closure.sendclosuresmess");
        Route::get('closureemergmess-{orgID}',[ClosureReportsController::class,'closureEmergMess'])->name('closure.emergmess');
        //---------------------------Regional Administration-----------------------//

        //---------------------------FlashAlert Tools-----------------------//
        Route::get('fa-closurereports',[FAToolsController::class,'fa_closurereports'])->name('fa.closurereports');
        Route::match(array('GET','POST'),'closurereports-Submission',[FAToolsController::class,'fa_closurereportsSubmission'])->name('fa.closurereportssubmission');
        Route::match(array('GET','POST'),'Post-N-R',[NewsReleaseController::class,'postNews'])->name('fa.postnewsrelease');
        Route::match(array('GET','POST'),'N-R-Archive',[NewsReleaseController::class,'newsReleaseArchive'])->name('fa.newsReleaseArchives');
        Route::match(['GET', 'POST'], 'fa-news-release', [NewsReleaseController::class, 'newsRelease'])->name('fa.fa-news-release');
        Route::post('postnewsrel',[NewsReleaseController::class,'postnewsrelMail'])->name('detailsform');   
        Route::post('fa-news-release/get-categories', [NewsReleaseController::class, 'getCategories'])->name('fa.fa-news-release.getCategories');
        Route::post('fa-news-release/get-org-data-for-org-cat', [NewsReleaseController::class, 'getOrgDataForOrgCat'])->name('fa.fa-news-release.getOrgDataForOrgCat');
        //---------------------------FlashAlert Tools-----------------------//

        //---------------------------Station Recipiant-----------------------//
        Route::match(array('GET','POST'),'station-recipiant',[StationRecipiant::class,'index'])->name('station.recipiant');
        Route::match(array('GET','POST'),'station-recipiant-page',[StationRecipiant::class,'page'])->name('station.page');
        Route::match(array('GET','POST'),'get-city',[StationRecipiant::class,'getcity'])->name('get.city');
        Route::match(array('GET','POST'),'add-station',[StationRecipiant::class,'addstation'])->name('add.station');
        Route::get('edit-station/{id}', [StationRecipiant::class,'editstation'])->name('edit.station');
        Route::get('edit-station-email/{id}', [StationRecipiant::class,'editstationemail']);
        Route::match(array('GET','POST'),'add-station-email',[StationRecipiant::class,'addstationemail'])->name('add.station.email');
        Route::get('delete-station/{id}', [StationRecipiant::class,'deletestation']);
        Route::get('delete-station-email/{id}', [StationRecipiant::class,'deletestationemail']);
        Route::get('station-ftp/{id}',[StationRecipiant::class,'stationftp'])->name('station.ftp');
        Route::get('edit-ftp/{id}', [StationRecipiant::class,'editftp']);
        Route::match(array('GET','POST'),'add-ftp',[StationRecipiant::class,'addftp'])->name('add.ftp');
        Route::get('req-update/{id}', [StationRecipiant::class,'requpdate']);
         //---------------------------Station Recipiant-----------------------//

        //---------------------------News Media recipients-----------------------//
        Route::match(array('GET','POST'),'news-media-recipients',[StationRecipiant::class,'newsmediarecipients'])->name('news.media.recipients');
        //---------------------------News Media recipients-----------------------//
         //---------------------------------------Style Templates/Report Pages----------------------------------//
        Route::match(array('GET','POST'),'style-templates',[StationRecipiant::class,'styletemplates'])->name('style.templates');
        Route::match(array('GET','POST'),'add-style-temp',[StationRecipiant::class,'addstyletemp'])->name('add.style.temp');
        Route::get('styletempedit/{id}', [StationRecipiant::class,'styletempedit']);
        Route::get('styletempdel/{id}', [StationRecipiant::class,'styletempdel']);
         //---------------------------------------Style Templates/Report Pages----------------------------------//
         //---------------------------------------add sub category----------------------------------//
        Route::get('sub-cat/{id}', [RegionalUserManagementController::class,'subcat']); 
        Route::post('addsubcat', [RegionalUserManagementController::class,'addsubcat'])->name('addsub.org'); 
        Route::match(array('GET','POST'),'emailaddress', [AutoConfirEmailController::class,'emailaddress'])->name('email.address'); 
        Route::match(array('GET','POST'),'subsdisstatus', [CommonController::class,'subsdispatch'])->name('subs.dis.status'); 
        Route::match(array('GET','POST'),'emrreportarch', [CommonController::class,'emrreportarch'])->name('emr.report.arch');
        });
});
    //   Edit the Auto-Confirmation Email Template

    Route::get('/sp2/index.html', [AutoConfirEmailController::class, 'AutoConfirmEmail'])->name("autoconfirmemail");
//--------------------------------------Backend----------------------------------------------
