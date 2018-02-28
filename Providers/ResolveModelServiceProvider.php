<?php

namespace App\Providers;

use App\Models\BannerType;
use App\Models\Batch;
use App\Models\BatchReservation;
use App\Models\Category;
use App\Models\CategoryKbn;
use App\Models\Prize;
use App\Models\BillingMenu;
use App\Models\ContactType;
use App\Models\Crane;
use App\Models\CraneStatus;
use App\Models\MailMagazine;
use App\Models\PointHistory;
use App\Models\Country;
use App\Models\PrizeCategory;
use App\Models\PrizeDelivery;
use App\Models\PrizeDeliveryStatus;
use App\Models\SendgridLog;
use App\Models\SystemSetting;
use App\Models\Tuser;
use Illuminate\Support\ServiceProvider;
use App\Models\MailFormat;
use App\Models\QA;
use App\Models\BannerImages;

class ResolveModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('m_mail_format', function ($app) {
            return new MailFormat();
        });

        $this->app->bind('m_batch', function ($app) {
           return new Batch();
        });

        $this->app->bind('t_batch_reservation', function ($app) {
            return new BatchReservation();
        });

        $this->app->bind('t_user', function ($app) {
            return new Tuser();
        });

        $this->app->bind('t_prize', function ($app) {
            return new Prize();
        });

        $this->app->bind('t_category', function ($app) {
            return new Category();
        });

        $this->app->bind('m_category_kbn', function ($app) {
            return new CategoryKbn();
        });

        $this->app->bind('t_crane', function ($app) {
            return new Crane();
        });

        $this->app->bind('m_crane_status', function ($app) {
            return new CraneStatus();
        });

        $this->app->bind('t_billing_menu', function () {
            return new BillingMenu();
        });

        $this->app->bind('t_banner_image', function () {
            return new BannerImages();
        });

        $this->app->bind('m_banner_type', function () {
            return new BannerType();
        });

        $this->app->bind('m_system_setting', function () {
            return new SystemSetting();
        });

        $this->app->bind('m_country', function ($app) {
            return new Country();
        });

        $this->app->bind('m_qa', function ($app) {
            return new QA();
        });

        $this->app->bind('m_prize_delivery_status', function ($app) {
            return new PrizeDeliveryStatus();
        });

        $this->app->bind('category_kbn', function ($app) {
            return new CategoryKbn();
        });

        $this->app->bind('t_category', function ($app) {
            return new Category();
        });

        $this->app->bind('m_contact_type', function ($app) {
            return new ContactType();
        });

        $this->app->bind('t_prize_delivery', function ($app) {
            return new PrizeDelivery();
        });
        $this->app->bind('t_prize_category', function ($app) {
            return new PrizeCategory();
        });

        $this->app->bind('t_point_history', function ($app) {
            return new PointHistory();
        });

        $this->app->bind('mailmagazine', function ($app) {
            return new MailMagazine();
        });

        $this->app->bind('sendgrid_log', function ($app) {
            return new SendgridLog();
        });
    }
}
