<?php

namespace Vicoders\Input;

use Illuminate\Support\ServiceProvider;
use Vicoders\Input\Abstracts\Input;
use Vicoders\Input\Facades\ThemeOptionManager;

class InputsServiceProvider extends ServiceProvider
{

    
    public function register()
    {

        // All your actions that registered here will be bootstrapped

        $this->app->singleton('ContactFormManager', function ($app) {
            return new Manager;
        });

        if (is_admin()) {
            $this->registerAdminPostAction();
            $this->registerOptionPage(); // it require nf/theme-option package in template
        }
        $this->registerAction();
    }

    public function registerCommand()
    {
        // Register your command here, they will be bootstrapped at console
        //
        // return [
        //     PublishCommand::class,
        // ];
    }

    public function registerAdminPostAction()
    {
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_media();
        });

        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_style(
                'input-style',
                wp_slash(get_stylesheet_directory_uri() . '/vendor/nf/input/assets/dist/app.css'),
                false
            );
            wp_enqueue_script(
                'input-scripts',
                wp_slash(get_stylesheet_directory_uri() . '/vendor/nf/input/assets/dist/app.js'),
                'jquery',
                '1.0',
                true
            );
        });
    }

    public function registerOptionPage()
    {
        // \NightFury\Option\Facades\ThemeOptionManager::add([
            
        // ]);
    }
    public function handle()
    {
        $data['message'] = 'An error while save data!';
        $request         = Request::except('action', 'type', 'name_slug', 'status');
        $type            = Request::only('type');
        $name_slug       = Request::only('name_slug');
        $status          = Request::only('status');
        if (!empty($request)) {
            $contact            = new Contact();
            $contact->data      = json_encode($request);
            $contact->type      = $type['type'];
            $contact->name_slug = $name_slug['name_slug'];
            $contact->status    = $status['status'];
            $result             = $contact->save();
            if ($result) {
                $data['message']      = __('Xin cảm ơn', 'vicoders');
                $data['current_lang'] = pll_current_language();
            }

        }

        do_action('contact_form_submitted', ['request' => Request::all(), 'item' => $contact]);

        wp_send_json(compact('data'));
    }
    public function registerAction()
    {
        add_action('wp_ajax_handle_contact_form', [$this, 'handle']);
        add_action('wp_ajax_nopriv_handle_contact_form', [$this, 'handle']);
    }
}
