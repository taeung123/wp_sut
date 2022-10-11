<?php
$app = require_once __DIR__ . '/bootstrap/app.php';

/*
 * Set post views count using post meta
 */

class MY_Menu_Walker extends Walker_Nav_Menu
{

    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);

        $output .= "\n<span class='sub-menu-button'>+</span>
        <ul class=\"dropdown-content\">
               <div class='container'>
                    <div class='header'>
                        <h2>Nội dung</h2>
                    </div>
                    <hr>
                    <div class=' wapper-mega-menu wapper-sub-menu'>


        \n";

    }
    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '
                     </div>
                </div>
        </ul>';
    }

}

if (!function_exists('nf_setup')) {
    function nf_setup()
    {

        add_theme_support("title-tag");

        // Add woocommerce
        add_theme_support('woocommerce');

        // Adds custom header
        add_theme_support('custom-header');

        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');

        // This theme uses a custom image size for featured images, displayed on "standard" posts.
        add_theme_support('post-thumbnails');

        set_post_thumbnail_size(370, 9999); // Unlimited height, soft crop

        $thumbnail_option = [
            'thumbnail_size_w' => 300,
            'thumbnail_size_h' => 300,
            'thumbnail_crop' => 1,
            'medium_size_w' => 700,
            'medium_size_h' => 466,
            'medium_crop' => 1,
            'large_size_w' => 720,
            'large_size_h' => 460,
            'large_crop' => 1,
        ];
        foreach ($thumbnail_option as $option => $value) {
            if (get_option($option, '') != $value) {
                update_option($option, $value);
            }

        }
        add_image_size('nf-700-444', 700, 444, true);
    }
    if (function_exists('add_action')) {
        add_action('after_setup_theme', 'nf_setup');
    }
}

add_theme_support('title-tag');
function load_custom_fonts($init)
{

    $stylesheet_url = 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap'; // Note #1

    if (empty($init['content_css'])) {
        $init['content_css'] = $stylesheet_url;
    } else {
        $init['content_css'] = $init['content_css'] . ',' . $stylesheet_url;
    }

    $font_formats = isset($init['font_formats']) ? $init['font_formats'] : 'Arial=arial';

    $custom_fonts = 'Open sans=Open Sans;';

    $init['font_formats'] = $custom_fonts . $font_formats;

    return $init;
}

add_filter('tiny_mce_before_init', 'load_custom_fonts'); // Note #4
function load_custom_fonts_frontend()
{

    echo '<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap">';
}
add_action('admin_head', 'load_custom_fonts_frontend');

/*Register WordPress  Gutenberg CPT */
function cw_post_type()
{

    register_post_type(
        'Admission',
        // WordPress CPT Options Start
        [
            'labels' => [
                'name' => __('Admission'),
                'singular_name' => __('Admission'),
            ],
            'has_archive' => true,
            'public' => true,
            'rewrite' => ['slug' => 'admission'],
            'show_in_rest' => true,
            'supports' => ['editor'],
        ]
    );
}
add_action('init', 'cw_post_type');

add_action('acf/init', 'my_acf_blocks_init');
function my_acf_blocks_init()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        acf_register_block_type(array(
            'name' => 'vc_fancybox',
            'title' => __('VC Fancy Box'),
            'description' => __('A custom Gutenburg block.'),
            'render_template' => '/blocks/fancybox.php',
            'category' => 'formatting',
        ));
        acf_register_block_type(array(
            'name' => 'vc_chapter',
            'title' => __('VC Chapter'),
            'description' => __('A custom Gutenburg block.'),
            'render_template' => '/blocks/chapter.php',
            'category' => 'formatting',
        ));
        acf_register_block_type(array(
            'name' => 'vc_image',
            'title' => __('VC Image'),
            'description' => __('A custom Gutenburg block.'),
            'render_template' => '/blocks/image.php',
            'category' => 'formatting',
        ));
        acf_register_block_type([
            'name' => 'vc_accordion',
            'title' => __('VC Accordion'),
            'description' => __('VC Accordion Gutenburg Block'),
            'render_template' => '/blocks/accordion.php',
            'category' => 'formatting'
        ]);

            acf_register_block_type([
                'name' => 'vc_post_slider',
                'title' => 'VC Post Slider',
                'description' => 'VC Post Slider Gutenburg Block',
                'render_template' => '/blocks/postSliderBlock.php',
                'category' => 'formatting'
            ]);
    }
}

use NightFury\Option\Facades\ThemeOptionManager;
use Vicoders\ContactForm\Facades\ContactFormManager;
use Vicoders\Input\Abstracts\Input;
use Vicoders\Input\Abstracts\Type;

session_start();
$location = $_SESSION['contactInfo']['location'];
$duration = $_SESSION['contactInfo']['duration'];
$type = $_SESSION['contactInfo']['type'];
$take_time = $_SESSION['contactInfo']['take_time'];

ini_set('upload_max_size', '200M');
ini_set('post_max_size', '200M');
ini_set('max_execution_time', '300');

function scanwp_buttons($buttons)
{

    array_unshift($buttons, 'fontsizeselect');
    return $buttons;
}

add_filter('mce_buttons_2', 'scanwp_buttons');

///Font family test
function add_google_fonts()
{
    wp_enqueue_style('google_web_fonts', 'https://fonts.googleapis.com/css?family=Open+Sans|Roboto');
}

add_action('wp_enqueue_scripts', 'add_google_fonts');

add_filter('flush_rewrite_rules_hard', '__return_false');

function nf_post_thumbnail($img_size = '')
{

    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
        return;
    }

    $img_size = !empty($img_size) ? $img_size : 'large';
    the_post_thumbnail($img_size);
}

function nf_limit_words($string, $word_limit)
{
    $words = explode(' ', $string, ($word_limit + 1));
    if (count($words) > $word_limit) {
        array_pop($words);
        return implode(' ', $words) . '...';
    }
    if (count($words) <= $word_limit) {
        return implode(' ', $words);
    }
}

ContactFormManager::add([
    'name' => 'register-form',
    'type' => Type::CONTACT,
    'style' => 'form-2',
    'email_enable' => true, /* default - false */
    'email_variables' => [
        'name' => 'NAME_FIELD',
        'email' => 'EMAIL_FIELD',
    ],
    'email_config' => [
        'domain_api' => 'http://sendmail.vicoders.com/',
        'mail_host' => 'HOST MAIL',
        'mail_port' => 'PORT',
        'mail_from' => 'EMAIL_FROM',
        'mail_name' => 'YOUR NAME',
        'mail_username' => 'EMAIL SEND',
        'mail_password' => 'EMAIL PASSWORD',
        'mail_encryption' => 'tls',
    ],
    'email_template' => [
        [
            'name' => 'Template 1',
            'path' => 'PATH_TO_HTML_TEMPLATE',
            'params' => [
                'name_author' => 'Garung 123',
                'post_title' => 'this is title 123',
                'content' => 'this is content 123',
                'link' => 'http://google.com',
                'site_url' => site_url(),
            ],
        ],
        [
            'name' => 'Template 2',
            'path' => 'PATH_TO_HTML_TEMPLATE',
            'params' => [
                'example_variable' => 'demo',
            ],
        ],
    ],
    'status' => [
        [
            'id' => 1,
            'name' => 'pending',
            'is_default' => true,
        ],
        [
            'id' => 2,
            'name' => 'confirmed',
            'is_default' => false,
        ],
        [
            'id' => 3,
            'name' => 'cancel',
            'is_default' => false,
        ],
        [
            'id' => 4,
            'name' => 'complete',
            'is_default' => false,
        ],
    ],
    'fields' => [

        [
            'label' => '',
            'name' => 'label_register_form', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'label_register_form',
                'placeholder' => '',
                'text' => pll_current_language('slug') === 'vi' ? '<p>PHIẾU ĐĂNG KÝ XÉT TUYỂN VÀ NHẬP HỌC</p><p>ĐẠI HỌC SWINBURNE (VIỆT NAM)</p>' : '<p>REGISTRATION FORM AND ADMISSION </p> <p>SWINBURNE UNIVERSITY (VIETNAM)</p>',
                'image' => 'resources/assets/images/header/Logo_SUT.jpg',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Ảnh chân dung' : 'Upload Image',
            'name' => 'avatar', // the key of option
            'type' => Input::FILE,
            'attributes' => '',
        ],

        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>1. Họ chữ đệm và tên của thí sinh:*</b> <i>(viết đúng như giấy khai sinh bằng chữ in hoa có dấu)</i>' : '<b>1.Full name*:</b>',
            'name' => 'avatar_link', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'avatar_input',
                'placeholder' => '',
            ],
        ],
        [
            'label' => '',
            'name' => 'full_name', // the key of option
            'type' => Input::TEXT,
            'required' => true,
            'attributes' => [
                'class' => 'name-input',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>Giới tính*:</b>' : '<b>Gender:</b>',
            'name' => 'input_hidden', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'label_gender',
            ],
        ],
        [
            'label' => '',
            'name' => 'gender', // the key of option
            'type' => Input::RADIO,
            'required' => true,
            'attributes' => [
                'class' => 'gender-male',
                'id' => 'gender-male',
                'placeholder' => '',
                'value' => 'male',
                'text' => pll_current_language('slug') === 'vi' ? 'Nam' : 'Male',
            ],
        ],
        [
            'label' => '',
            'name' => 'gender', // the key of option
            'type' => Input::RADIO,
            'attributes' => [
                'class' => 'gender-female',
                'id' => 'gender-female',
                'placeholder' => '',
                'value' => 'female',
                'text' => pll_current_language('slug') === 'vi' ? 'Nữ' : 'female',
            ],
        ],

        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>2. Ngày, tháng, năm sinh*:</b>' : '<b>2. Date of birth*:</b>',
            'name' => 'day', // the key of option
            'type' => Input::DATE,
            'required' => true,
            'attributes' => [
                'class' => 'day',
                'placeholder' => 'dd/mm/yyyy',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>3. Nơi sinh*</b> <i>(Tỉnh/Thành phố):</i>' : '<b>3. Place of birth*</b> <i>province/city:</i>',
            'name' => 'live', // the key of option
            'type' => Input::TEXT,
            'required' => true,
            'attributes' => [
                'class' => 'live',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Dân tộc*:' : 'Nation*:',
            'name' => 'nation', // the key of option
            'type' => Input::TEXT,
            'required' => true,
            'attributes' => [
                'class' => 'nation',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Quốc tịch*:' : 'Nationality*:',
            'name' => 'nationality', // the key of option
            'type' => Input::TEXT,
            'required' => true,
            'attributes' => [
                'class' => 'nationality',
                'placeholder' => '',
            ],
        ],

        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>4. Trường THPT* </b><i>(Ghi rõ tên trường):</i>' : '<b>4. High school*:</b>',
            'name' => 'high_school', // the key of option
            'type' => Input::TEXT,
            'required' => true,
            'attributes' => [
                'class' => 'high_school',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Tỉnh/ TP *:' : 'Province/ City*:',
            'name' => 'city', // the key of option
            'type' => Input::TEXT,
            'required' => true,
            'attributes' => [
                'class' => 'city',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Quận/ Huyện*:' : 'District*:',
            'name' => 'district', // the key of option
            'type' => Input::TEXT,
            'required' => true,
            'attributes' => [
                'class' => 'district',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>5. Đối với thí sinh chưa tốt nghiệp: điểm trung bình năm lớp 11 hoặc 12</b><i> (dự kiến)</i>' : '<b>5. For undergraduates: GPA class 11 or 12</b><i> (expected)</i>',
            'name' => 'undergraduates', // the key of option
            'type' => Input::NUMBER,
            'attributes' => [
                'class' => 'undergraduates',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>6. Đối với thí sinh đã tốt nghiệp:</b>' : '<b>6. For graduates:</b>',
            'name' => 'input_hidden', // the key of option
            'type' => Input::TEXT,
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Năm tốt nghiệp THPT:' : 'Year of high school graduation:',
            'name' => 'year_graduates', // the key of option
            'type' => Input::NUMBER,
            'attributes' => [
                'class' => 'year_graduates',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Xếp loại tốt nghiệp:' : 'Graduation rating:',
            'name' => 'graduation_rating', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'required' => false,
                'class' => 'graduation_rating',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Điểm tốt nghiệp:' : 'Graduation:',
            'name' => 'graduation', // the key of option
            'type' => Input::NUMBER,
            'attributes' => [
                'required' => false,
                'class' => 'graduation',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>7. Trình độ tiếng Anh*:</b><i> Đánh giá trình độ của bạn:</i>' : '<b>7. English level*:</b> <i>Assess your level:</i>',
            'name' => 'input_hidden', // the key of option
            'type' => Input::TEXT,
        ],
        [
            'label' => '',
            'name' => 'english_level', // the key of option
            'type' => Input::RADIO,
            'required' => true,
            'attributes' => [
                'class' => 'unknown',
                'placeholder' => '',
                'value' => 'unknown',
                'rtl' => true,
                'text' => pll_current_language('slug') === 'vi' ? 'Chưa biết' : 'Unknown',
            ],
        ],
        [
            'label' => '',
            'name' => 'english_level', // the key of option
            'type' => Input::RADIO,
            'attributes' => [
                'class' => 'basic',
                'placeholder' => '',
                'value' => 'basic',
                'checked' => false,
                'rtl' => true,
                'text' => pll_current_language('slug') === 'vi' ? 'Cơ bản' : 'Basic',
            ],
        ],
        [
            'label' => '',
            'name' => 'english_level', // the key of option
            'type' => Input::RADIO,
            'attributes' => [
                'class' => 'good',
                'placeholder' => '',
                'value' => 'good',
                'checked' => false,
                'rtl' => true,
                'text' => pll_current_language('slug') === 'vi' ? 'Khá' : 'Good',
            ],
        ],
        [
            'label' => '',
            'name' => 'english_level', // the key of option
            'type' => Input::RADIO,
            'attributes' => [
                'class' => 'master',
                'placeholder' => '',
                'value' => 'master',
                'checked' => false,
                'rtl' => true,
                'text' => pll_current_language('slug') === 'vi' ? 'Tốt' : 'Master',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Chứng chỉ tiếng Anh: <i>(nếu có)</i>' : 'English certificate: <i>(if owned)</i>',
            'name' => 'english_certificate', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'english_certificate',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Ngày thi:' : 'Test day:',
            'name' => 'test_day', // the key of option
            'type' => Input::DATE,
            'attributes' => [
                'required' => false,
                'class' => 'test_day',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Kết quả:' : 'Result:',
            'name' => 'result', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'required' => false,
                'class' => 'result',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>8. Hộ khẩu thường trú*</b> <i>(ghi rõ xã/phường, huyện/quận, tỉnh/thành phố):</i>' : '<b>8. Permanent residence* </b><i>(specify commune/ward, district/county, province/city):</i>',
            'name' => 'permanent_residence', // the key of option
            'type' => Input::TEXT,
            'required' => true,
            'attributes' => [
                'class' => 'permanent_residence',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>9. Số CMTND*</b> <i>(Hoăc hộ chiếu):</i>' : '<b>9. Identity card number:</b>',
            'name' => 'identity_card_number', // the key of option
            'type' => Input::NUMBER,
            'attributes' => [
                'class' => 'identity_card_number',
                'placeholder' => '',
                'visiable-type' => true,
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Ngày cấp:' : 'Date Provider:',
            'name' => 'date_provider', // the key of option
            'type' => Input::DATE,
            'attributes' => [
                'class' => 'date_provider',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Nơi cấp:' : 'Issued by:',
            'name' => 'issued_by', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'issued_by',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Ảnh CMT, hộ chiếu, thẻ học sinh ( Mặt trước )' : 'Identity card Image (front)',
            'name' => 'font_cmt', // the key of option
            'type' => Input::FILE,
            'attributes' => '',
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Ảnh CMT, hộ chiếu, thẻ học sinh ( Mặt sau )' : 'Identity card Image (back)',
            'name' => 'back_cmt', // the key of option
            'type' => Input::FILE,
            'attributes' => '',
        ],
        [
            'label' => '',
            'name' => 'font_cmt_link', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'font_cmt_link',
            ],
        ],
        [
            'label' => '',
            'name' => 'back_cmt_link', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'back_cmt_link',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>10. Địa chỉ liên hệ</b> <i>(bỏ qua nếu trùng mục 8):</i>' : '<b>10. address </b><i>(skip if the same item 8):</i>',
            'name' => 'address', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'address',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>11. Số điện thoại di động*:</b>' : '<b>11. Mobile*:</b>',
            'name' => 'mobile', // the key of option
            'type' => Input::NUMBER,
            'required' => true,
            'attributes' => [
                'required' => false,
                'class' => 'mobile',
                'placeholder' => '',
                'visiable-type' => true,
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Số điện thoại gia đình:' : 'Home phone:',
            'name' => 'home_phone', // the key of option
            'type' => Input::NUMBER,
            'attributes' => [
                'class' => 'home_phone',
                'placeholder' => '',
                'visiable-type' => true,
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Email:' : 'Email:',
            'name' => 'email', // the key of option
            'type' => Input::EMAIL,
            'attributes' => [
                'required' => false,
                'class' => 'email',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>12.Họ và tên phụ huynh</b> <i>(bố, mẹ hoặc người giám hộ):</i>' : '<b>12. Full name of parent</b><i> (father, mother or guardian):</i>',
            'name' => 'full_name_father', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'full_name_father',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Nghề nghiệp:' : 'Job:',
            'name' => 'father_job', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'father_job',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Nơi công tác:' : 'Work place:',
            'name' => 'father_work_place', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'father_work_place',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Email:' : 'Email:',
            'name' => 'father_email', // the key of option
            'type' => Input::EMAIL,
            'attributes' => [
                'class' => 'father_email',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Số điện thoại:' : 'Mobile:',
            'name' => 'father_mobile', // the key of option
            'type' => Input::NUMBER,
            'attributes' => [
                'class' => 'father_mobile',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>13. Ngành đăng ký*:</b><i> &lt;cập nhật theo quy chế tuyển sinh&gt;</i>' : '<b>13. Specialized registration*:</b> <i><updated according to admissions regulations> </i>',
            'name' => 'input_hidden', // the key of option
            'type' => Input::TEXT,
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>Ngành công nghệ thông tin</b>' : '<b>Information technology majors</b>',
            'name' => 'information_technology_majors', // the key of option
            'type' => Input::CHECKBOX,
            'required' => true,
            'attributes' => [
                'class' => 'information_technology_majors registration',
                'placeholder' => '',
                'value' => 'information_technology_majors',
                'text' => pll_current_language('slug') === 'vi' ? '<b>Ngành công nghệ thông tin</b>' : '<b>Information technology majors</b>',
            ],
        ],
        [
            'label' => '',
            'name' => 'information_technology', // the key of option
            'type' => Input::RADIO,
            'required' => true,
            'attributes' => [
                'class' => 'software_development registration',
                'placeholder' => '',
                'value' => 'software_development',
                'text' => pll_current_language('slug') === 'vi' ? 'Công nghệ phần mềm' : 'Software Technology',
            ],
        ],
        [
            'label' => '',
            'name' => 'information_technology', // the key of option
            'type' => Input::RADIO,
            'attributes' => [
                'class' => 'data_management registration',
                'placeholder' => '',
                'value' => 'data_management',
                'text' => pll_current_language('slug') === 'vi' ? 'Quản trị hệ thống' : 'System management',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>Ngành kinh doanh</b>' : '<b>Business majors</b>',
            'name' => 'business_majors', // the key of option
            'type' => Input::CHECKBOX,
            'attributes' => [
                'class' => 'business_majors registration',
                'placeholder' => '',
                'value' => 'business_majors',
                'text' => pll_current_language('slug') === 'vi' ? '<b>Ngành kinh doanh</b>' : '<b>Business majors</b>',
            ],
        ],
        [
            'label' => '',
            'name' => 'business_administration', // the key of option
            'type' => Input::RADIO,
            'attributes' => [
                'class' => 'business_admin registration',
                'placeholder' => '',
                'value' => 'business_admin',
                'text' => pll_current_language('slug') === 'vi' ? 'Quản trị kinh doanh' : 'Business administration',
            ],
        ],
        [
            'label' => '',
            'name' => 'business_administration', // the key of option
            'type' => Input::RADIO,
            'attributes' => [
                'class' => 'marketing registration',
                'placeholder' => '',
                'value' => 'marketing',
                'text' => pll_current_language('slug') === 'vi' ? 'Marketing' : 'Marketing',
            ],
        ],
        [
            'label' => '',
            'name' => 'business_administration', // the key of option
            'type' => Input::RADIO,
            'attributes' => [
                'class' => 'international_bussiness registration',
                'placeholder' => '',
                'value' => 'international_bussiness',
                'text' => pll_current_language('slug') === 'vi' ? 'Kinh doanh quốc tế' : 'International bussiness',
            ],
        ],

        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>Ngành truyền thông đa phương tiện</b>' : '<b>Media and communication majors</b>',
            'name' => 'media_communication_majors', // the key of option
            'type' => Input::CHECKBOX,
            'attributes' => [
                'class' => 'media_communication_majors registration',
                'placeholder' => '',
                'value' => 'media_communication_majors',
                'text' => pll_current_language('slug') === 'vi' ? '<b>Ngành truyền thông đa phương tiện</b>' : '<b>Media and communication majors</b>',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>14. Các giấy tờ cần thiết để hoàn thành hồ sơ:</b>' : '<b>14. Documents required to complete the profile:</b>',
            'name' => 'input_hidden', // the key of option
            'type' => Input::TEXT,
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Kết quả học tập/Học bạ gần nhất (bao gồm kết quả học tập lớp 12)*' : 'Learning Results / School Profile*',
            'name' => 'learning_results', // the key of option
            'type' => Input::FILE,
            'required' => true,
            'attributes' => '',
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Giấy chứng nhận kết quả thi THPT hoặc bằng tốt nghiệp THPT (nếu có)' : 'Certificate of high school exam results or high school diploma',
            'name' => 'school_diploma', // the key of option
            'type' => Input::FILE,
            'attributes' => '',
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Chứng chỉ tiếng Anh quốc tế (IELTS, PTE, Toef hoặc Dolingo...)' : 'English certificate (IELTS, PTE, Toef or Dolingo...)',
            'name' => 'english_certificate_file', // the key of option
            'type' => Input::FILE,
            'attributes' => '',
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Các hồ sơ khác về thành tích học tập ngoại khóa, các cuộc thi, sự kiện tham gia' : 'Other records about learning achievements, extra-curricular activities',
            'name' => 'learning_achievements', // the key of option
            'type' => Input::FILE,
        ],
        [
            'label' => '',
            'name' => 'text_note', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'text' => pll_current_language('slug') === 'vi' ? 'Thí sinh cần upload đầy đủ hồ sơ cho quá trình xét tuyển; các hồ sơ về ảnh chân dung, chứng minh thư / hộ chiếu, kết quả học tập / học bạ là các mục bắt buộc cần phải có để xem xét xét tuyển; hồ sơ các mục còn lại có thể bổ sung sau nếu chưa có' : '
				Candidates need to upload full documents for the admission process; profiles of portrait photo, ID card / passport, academic results / transcripts are required items to be considered for admission; The remaining records of items can be added later',
            ],
        ],
        [
            'label' => '',
            'name' => 'birth_certificate_link', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'birth_certificate_link',
            ],
        ],
        [
            'label' => '',
            'name' => 'learning_results_link', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'learning_results_link',
            ],
        ],
        [
            'label' => '',
            'name' => 'school_diploma_link', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'school_diploma_link',
            ],
        ],
        [
            'label' => '',
            'name' => 'english_certificate_link', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'english_certificate_link',
            ],
        ],
        [
            'label' => '',
            'name' => 'learning_achievements_link', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'learning_achievements_link',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>15. Đăng kí phỏng vấn xét học bổng Đại học Swinburne Việt Nam*:</b>' : '<b>15. Sign up for a study interview at Swinburne University in Vietnam*:</b>',
            'name' => 'input_hidden', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'label_sign_up',
            ],
        ],
        [
            'label' => '',
            'name' => 'Sign_up', // the key of option
            'type' => Input::RADIO,
            'required' => true,
            'attributes' => [
                'class' => 'Sign_up_yes',
                'placeholder' => '',
                'value' => 'Sign_up_yes',
                'text' => pll_current_language('slug') === 'vi' ? 'Có' : 'Yes',
            ],
        ],
        [
            'label' => '',
            'name' => 'Sign_up', // the key of option
            'type' => Input::RADIO,
            'attributes' => [
                'class' => 'Sign_up_no',
                'placeholder' => '',
                'value' => 'Sign_up_no',
                'checked' => false,
                'text' => pll_current_language('slug') === 'vi' ? 'Không' : 'No',
            ],
        ],

        [
            'label' => pll_current_language('slug') === 'vi' ? '<b>16. Cam kết của thí sinh*:</b>' : '<b>16. Commitment of candidates*:</b>',
            'name' => 'input_hidden', // the key of option
            'type' => Input::TEXT,
        ],
        [
            'label' => '',
            'name' => 'candidates', // the key of option
            'type' => Input::CHECKBOX,
            'required' => true,
            'attributes' => [
                'class' => 'candidates',
                'placeholder' => '',
                'value' => 'candidates',
                'checked' => false,
                'text' => pll_current_language('slug') === 'vi' ? 'Tôi cam đoan những lời khai trong phiếu này là đúng sự thật. Nếu sai tôi chịu hoàn toàn trách nhiệm. Tôi đã đọc kỹ và đồng ý tuân thủ nghiêm túc các quy định, chính sách, quy định tài chính của Trường Đại học Swinburne Vietnam và đóng học phí đúng hạn quy định.' : 'I guarantee the statements on this form are true. If false I assume full responsibility. I have carefully read and agree to strictly comply with Swinburne University\'s financial regulations, policies and regulations and pay tuition on time.',
            ],
        ],
        [
            'value' => pll_current_language('slug') === 'vi' ? 'Đăng kí' : 'Register',
            'type' => Input::SUBMIT,
            'attributes' => [
                'class' => 'send btn-register',
            ],
        ],

    ],
]);

ThemeOptionManager::add([
    'name' => 'Banner',
    'fields' => [
        [
            'label' => 'Banner home',
            'name' => 'banner_home',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Banner home 2',
            'name' => 'banner_home2',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Banner home vi',
            'name' => 'banner_home_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Banner home vi 2',
            'name' => 'banner_home_vi2',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'About',
            'name' => 'banner_about',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'About vi',
            'name' => 'banner_about_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Admission',
            'name' => 'banner_admission',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Admission vi',
            'name' => 'banner_admission_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Business',
            'name' => 'banner_business',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Business vi',
            'name' => 'banner_business_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Contact',
            'name' => 'banner_contact',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Contact vi',
            'name' => 'banner_contact_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Degrees and double degrees',
            'name' => 'double_degrees',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Degrees and double degrees vi',
            'name' => 'double_degrees_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Diplomas and certificates',
            'name' => 'certificates',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Diplomas and certificates vi',
            'name' => 'certificates_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Event',
            'name' => 'banner_event',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Event vi',
            'name' => 'banner_event_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Find us contact',
            'name' => 'find_us',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Find us contact vi',
            'name' => 'find_us_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Graduate study',
            'name' => 'graduate_study',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Graduate study vi',
            'name' => 'graduate_study_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'International',
            'name' => 'International',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'International vi',
            'name' => 'International_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Life at FPT',
            'name' => 'life_fpt',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Life at FPT vi',
            'name' => 'life_fpt_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'News',
            'name' => 'news_banner',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'News vi',
            'name' => 'news_banner_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Study options',
            'name' => 'study_options',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Study options vi',
            'name' => 'study_options_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Research banner',
            'name' => 'research_banner',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Research banner vi',
            'name' => 'research_banner_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Study with us',
            'name' => 'study_with_us',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Study with us vi',
            'name' => 'study_with_us_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Current student',
            'name' => 'current_student',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Current student vi',
            'name' => 'current_student_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],

        [
            'label' => 'Banner Lybrary',
            'name' => 'banner_lybrary',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Banner Lybrary vi',
            'name' => 'banner_lybrary_vi',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Page download',
            'name' => 'page_download_vn',
            'type' => Input::IMAGE,
            'required' => true,
        ],
        [
            'label' => 'Page download EN',
            'name' => 'page_download_en',
            'type' => Input::IMAGE,
            'required' => true,
        ],

    ],
]);
ThemeOptionManager::add([
    'name' => 'General',
    'fields' => [
        [
            'label' => 'Icon Đăng ký tìm hiểu',
            'name' => 'apply_now_icon',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Đăng ký tìm hiểu VN',
            'name' => 'apply_now_vn',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Link tiêu đề VN',
            'name' => 'apply_now_vn_title',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Đăng ký tìm hiểu EN',
            'name' => 'apply_now_en',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Link tiêu đề EN',
            'name' => 'apply_now_en_title',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Icon download',
            'name' => 'apply_now_icon_download',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Link download VN',
            'name' => 'apply_now_link_download_vn',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Link download EN',
            'name' => 'apply_now_link_download_en',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Title Tải tài liệu VN',
            'name' => 'title_apply_download_vn',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Title Tải tài liệu EN',
            'name' => 'title_apply_download_en',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Icon Đăng ký nhập học',
            'name' => 'icon_online_application',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Title Đăng ký hoc VN',
            'name' => 'title_online_application_vn',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Link đăng ký nhập học VN',
            'name' => 'link_online_application_vn',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Title Đăng ký hoc EN',
            'name' => 'title_online_application_en',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Link đăng ký nhập học EN',
            'name' => 'link_online_application_en',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Title Liên hệ với chúng tôi VN',
            'name' => 'title_contacs_vn',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Title Liên hệ với chúng tôi EN',
            'name' => 'title_contacs_en',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Phone icon',
            'name' => 'Phone_icon',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Phone Number',
            'name' => 'Phone_call',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Phone Ring',
            'name' => 'phone_ring',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Hotline',
            'name' => 'hotline',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Email icon',
            'name' => 'email_contact_icon',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Email',
            'name' => 'email_contact',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Email label',
            'name' => 'email_label',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Visit us href:',
            'name' => 'visit_us',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Visit us icon',
            'name' => 'visit_us_icon',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Visit us label',
            'name' => 'visit_us_label',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Visit us label vi',
            'name' => 'visit_us_label_vi',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Swinburne facebook icon',
            'name' => 'swinburne_fb_icon',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Swinburne facebook href:',
            'name' => 'swinburne_href',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Swinburne facebook name',
            'name' => 'swinburne_name_facebook',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Map location:',
            'name' => 'map_location',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Map directions',
            'name' => 'map_direction',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'ID App Facebook',
            'name' => 'id_app_fb',
            'type' => Input::TEXT,
            'required' => true,
        ],

    ],
]);

ThemeOptionManager::add([
    'name' => 'Current Student',
    'fields' => [
        [
            'label' => 'Study tool',
            'name' => 'study_tool_tab1',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Study item 1',
            'name' => 'study_item1_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1 link',
            'name' => 'study_item1_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2',
            'name' => 'study_item2_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 link',
            'name' => 'study_item2_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3',
            'name' => 'study_item3_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 link',
            'name' => 'study_item3_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4',
            'name' => 'study_item4_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 link',
            'name' => 'study_item4_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5',
            'name' => 'study_item5_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 link',
            'name' => 'study_item5_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6',
            'name' => 'study_item6_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 link',
            'name' => 'study_item6_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service title',
            'name' => 'service_title_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service item 1',
            'name' => 'service_item1_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 1 link',
            'name' => 'service_item1_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2',
            'name' => 'service_item2_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 link',
            'name' => 'service_item2_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3',
            'name' => 'service_item3_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 link',
            'name' => 'service_item3_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4',
            'name' => 'service_item4_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 link',
            'name' => 'service_item4_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5',
            'name' => 'service_item5_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 link',
            'name' => 'service_item5_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6',
            'name' => 'service_item6_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 link',
            'name' => 'service_item6_tab1_link',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Research title',
            'name' => 'service_title_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Research content',
            'name' => 'service_content_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'See more',
            'name' => 'see_more_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Find out link',
            'name' => 'find_out_tab1',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Graduates image',
            'name' => 'graduate_img_tab1',
            'type' => Input::IMAGE,
            'required' => false,
        ],

    ],
]);

ThemeOptionManager::add([
    'name' => 'Current Student vi',
    'fields' => [
        [
            'label' => 'Study tool vi',
            'name' => 'study_tool_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1 vi',
            'name' => 'study_item1_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1 link vi',
            'name' => 'study_item1_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 vi',
            'name' => 'study_item2_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 link vi',
            'name' => 'study_item2_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 vi',
            'name' => 'study_item3_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 link vi',
            'name' => 'study_item3_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 vi',
            'name' => 'study_item4_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 link vi',
            'name' => 'study_item4_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 vi',
            'name' => 'study_item5_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 link vi',
            'name' => 'study_item5_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 vi',
            'name' => 'study_item6_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 link vi',
            'name' => 'study_item6_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service title vi',
            'name' => 'service_title_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service item 1 vi',
            'name' => 'service_item1_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 1 link vi',
            'name' => 'service_item1_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 vi',
            'name' => 'service_item2_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 link vi',
            'name' => 'service_item2_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 vi',
            'name' => 'service_item3_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 link vi',
            'name' => 'service_item3_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 vi',
            'name' => 'service_item4_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 link vi',
            'name' => 'service_item4_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 vi',
            'name' => 'service_item5_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 link vi',
            'name' => 'service_item5_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 vi',
            'name' => 'service_item6_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 link vi',
            'name' => 'service_item6_tab1_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Research title vi',
            'name' => 'service_title_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Research content vi',
            'name' => 'service_content_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'See more',
            'name' => 'see_more_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Find out link',
            'name' => 'find_out_tab1_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Graduates image',
            'name' => 'graduate_img_tab1',
            'type' => Input::IMAGE,
            'required' => false,
        ],

    ],
]);

ThemeOptionManager::add([
    'name' => 'Future Student',
    'fields' => [
        [
            'label' => 'Study tool',
            'name' => 'study_tool_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1',
            'name' => 'study_item1_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1 link',
            'name' => 'study_item1_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2',
            'name' => 'study_item2_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 link',
            'name' => 'study_item2_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3',
            'name' => 'study_item3_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 link',
            'name' => 'study_item3_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4',
            'name' => 'study_item4_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 link',
            'name' => 'study_item4_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5',
            'name' => 'study_item5_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 link',
            'name' => 'study_item5_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6',
            'name' => 'study_item6_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 link',
            'name' => 'study_item6_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service title',
            'name' => 'service_title_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service item 1',
            'name' => 'service_item1_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 1 link',
            'name' => 'service_item1_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2',
            'name' => 'service_item2_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 link',
            'name' => 'service_item2_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3',
            'name' => 'service_item3_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 link',
            'name' => 'service_item3_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4',
            'name' => 'service_item4_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 link',
            'name' => 'service_item4_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5',
            'name' => 'service_item5_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 link',
            'name' => 'service_item5_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6',
            'name' => 'service_item6_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 link',
            'name' => 'service_item6_tab2_link',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Research title',
            'name' => 'service_title_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Research content',
            'name' => 'service_content_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'See more',
            'name' => 'see_more_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Find out link',
            'name' => 'find_out_tab2',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Graduates image',
            'name' => 'graduate_img_tab2',
            'type' => Input::IMAGE,
            'required' => false,
        ],

    ],
]);

ThemeOptionManager::add([
    'name' => 'Future Student vi',
    'fields' => [
        [
            'label' => 'Study tool vi',
            'name' => 'study_tool_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1 vi',
            'name' => 'study_item1_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1 link vi',
            'name' => 'study_item1_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 vi',
            'name' => 'study_item2_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 link vi',
            'name' => 'study_item2_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 vi',
            'name' => 'study_item3_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 link vi',
            'name' => 'study_item3_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 vi',
            'name' => 'study_item4_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 link vi',
            'name' => 'study_item4_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 vi',
            'name' => 'study_item5_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 link vi',
            'name' => 'study_item5_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 vi',
            'name' => 'study_item6_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 link vi',
            'name' => 'study_item6_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service title vi',
            'name' => 'service_title_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service item 1 vi',
            'name' => 'service_item1_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 1 link vi',
            'name' => 'service_item1_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 vi',
            'name' => 'service_item2_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 link vi',
            'name' => 'service_item2_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 vi',
            'name' => 'service_item3_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 link vi',
            'name' => 'service_item3_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 vi',
            'name' => 'service_item4_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 link vi',
            'name' => 'service_item4_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 vi',
            'name' => 'service_item5_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 link vi',
            'name' => 'service_item5_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 vi',
            'name' => 'service_item6_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 link vi',
            'name' => 'service_item6_tab2_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Research title vi',
            'name' => 'service_title_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Research content vi',
            'name' => 'service_content_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'See more',
            'name' => 'see_more_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Find out link',
            'name' => 'find_out_tab2_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Graduates image',
            'name' => 'graduate_img_tab2',
            'type' => Input::IMAGE,
            'required' => false,
        ],

    ],
]);

ThemeOptionManager::add([
    'name' => 'Research Student',
    'fields' => [
        [
            'label' => 'Study tool',
            'name' => 'study_tool_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1',
            'name' => 'study_item1_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1 link',
            'name' => 'study_item1_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2',
            'name' => 'study_item2_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 link',
            'name' => 'study_item2_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3',
            'name' => 'study_item3_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 link',
            'name' => 'study_item3_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4',
            'name' => 'study_item4_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 link',
            'name' => 'study_item4_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5',
            'name' => 'study_item5_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 link',
            'name' => 'study_item5_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6',
            'name' => 'study_item6_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 link',
            'name' => 'study_item6_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service title',
            'name' => 'service_title_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service item 1',
            'name' => 'service_item1_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 1 link',
            'name' => 'service_item1_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2',
            'name' => 'service_item2_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 link',
            'name' => 'service_item2_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3',
            'name' => 'service_item3_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 link',
            'name' => 'service_item3_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4',
            'name' => 'service_item4_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 link',
            'name' => 'service_item4_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5',
            'name' => 'service_item5_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 link',
            'name' => 'service_item5_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6',
            'name' => 'service_item6_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 link',
            'name' => 'service_item6_tab3_link',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Research title',
            'name' => 'service_title_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Research content',
            'name' => 'service_content_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'See more',
            'name' => 'see_more_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Find out link',
            'name' => 'find_out_tab3',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Graduates image',
            'name' => 'graduate_img_tab3',
            'type' => Input::IMAGE,
            'required' => false,
        ],

    ],
]);

ThemeOptionManager::add([
    'name' => 'Research Student vi',
    'fields' => [
        [
            'label' => 'Study tool vi',
            'name' => 'study_tool_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1 vi',
            'name' => 'study_item1_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1 link vi',
            'name' => 'study_item1_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 vi',
            'name' => 'study_item2_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 link vi',
            'name' => 'study_item2_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 vi',
            'name' => 'study_item3_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 link vi',
            'name' => 'study_item3_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 vi',
            'name' => 'study_item4_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 link vi',
            'name' => 'study_item4_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 vi',
            'name' => 'study_item5_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 link vi',
            'name' => 'study_item5_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 vi',
            'name' => 'study_item6_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 link vi',
            'name' => 'study_item6_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service title vi',
            'name' => 'service_title_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service item 1 vi',
            'name' => 'service_item1_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 1 link vi',
            'name' => 'service_item1_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 vi',
            'name' => 'service_item2_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 link vi',
            'name' => 'service_item2_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 vi',
            'name' => 'service_item3_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 link vi',
            'name' => 'service_item3_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 vi',
            'name' => 'service_item4_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 link vi',
            'name' => 'service_item4_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 vi',
            'name' => 'service_item5_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 link vi',
            'name' => 'service_item5_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 vi',
            'name' => 'service_item6_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 link vi',
            'name' => 'service_item6_tab3_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Research title vi',
            'name' => 'service_title_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Research content vi',
            'name' => 'service_content_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'See more',
            'name' => 'see_more_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Find out link',
            'name' => 'find_out_tab3_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Graduates image',
            'name' => 'graduate_img_tab3',
            'type' => Input::IMAGE,
            'required' => false,
        ],

    ],
]);

ThemeOptionManager::add([
    'name' => 'Graduates Student',
    'fields' => [
        [
            'label' => 'Study tool',
            'name' => 'study_tool_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1',
            'name' => 'study_item1_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1 link',
            'name' => 'study_item1_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2',
            'name' => 'study_item2_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 link',
            'name' => 'study_item2_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3',
            'name' => 'study_item3_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 link',
            'name' => 'study_item3_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4',
            'name' => 'study_item4_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 link',
            'name' => 'study_item4_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5',
            'name' => 'study_item5_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 link',
            'name' => 'study_item5_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6',
            'name' => 'study_item6_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 link',
            'name' => 'study_item6_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service title',
            'name' => 'service_title_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service item 1',
            'name' => 'service_item1_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 1 link',
            'name' => 'service_item1_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2',
            'name' => 'service_item2_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 link',
            'name' => 'service_item2_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3',
            'name' => 'service_item3_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 link',
            'name' => 'service_item3_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4',
            'name' => 'service_item4_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 link',
            'name' => 'service_item4_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5',
            'name' => 'service_item5_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 link',
            'name' => 'service_item5_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6',
            'name' => 'service_item6_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 link',
            'name' => 'service_item6_tab4_link',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Research title',
            'name' => 'service_title_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Research content',
            'name' => 'service_content_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'See more',
            'name' => 'see_more_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Find out link',
            'name' => 'find_out_tab4',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Graduates image',
            'name' => 'graduate_img_tab4',
            'type' => Input::IMAGE,
            'required' => true,
        ],

    ],
]);

ThemeOptionManager::add([
    'name' => 'Graduates Student vi',
    'fields' => [
        [
            'label' => 'Study tool vi',
            'name' => 'study_tool_tab4_vi',
            'type' => Input::TEXT,
            'required' => true,
        ],
        [
            'label' => 'Study item 1 vi',
            'name' => 'study_item1_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 1 link vi',
            'name' => 'study_item1_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 vi',
            'name' => 'study_item2_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 2 link vi',
            'name' => 'study_item2_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 vi',
            'name' => 'study_item3_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 3 link vi',
            'name' => 'study_item3_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 vi',
            'name' => 'study_item4_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 4 link vi',
            'name' => 'study_item4_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 vi',
            'name' => 'study_item5_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 5 link vi',
            'name' => 'study_item5_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 vi',
            'name' => 'study_item6_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Study item 6 link vi',
            'name' => 'study_item6_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service title vi',
            'name' => 'service_title_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Service item 1 vi',
            'name' => 'service_item1_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 1 link vi',
            'name' => 'service_item1_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 vi',
            'name' => 'service_item2_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 2 link vi',
            'name' => 'service_item2_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 vi',
            'name' => 'service_item3_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 3 link vi',
            'name' => 'service_item3_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 vi',
            'name' => 'service_item4_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 4 link vi',
            'name' => 'service_item4_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 vi',
            'name' => 'service_item5_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 5 link vi',
            'name' => 'service_item5_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 vi',
            'name' => 'service_item6_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Service item 6 link vi',
            'name' => 'service_item6_tab4_link_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Research title vi',
            'name' => 'service_title_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Research content vi',
            'name' => 'service_content_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'See more',
            'name' => 'see_more_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Find out link',
            'name' => 'find_out_tab4_vi',
            'type' => Input::TEXT,
            'required' => false,
        ],

        [
            'label' => 'Graduates image',
            'name' => 'graduate_img_tab4',
            'type' => Input::IMAGE,
            'required' => false,
        ],

    ],
]);

ThemeOptionManager::add([
    'name' => 'Custom footer Address',
    'fields' => [
        [
            'label' => 'Icon Address',
            'name' => 'icons_address',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Address 1 VN',
            'name' => 'name_address1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Address 1 EN',
            'name' => 'name_address1_en',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Address 2 VN',
            'name' => 'name_address2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Address 2 EN',
            'name' => 'name_address2_en',
            'type' => Input::TEXT,
            'required' => false,
        ],
		[
            'label' => 'Address 3 VN',
            'name' => 'name_address3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Address 3 EN',
            'name' => 'name_address3_en',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Icon Phone',
            'name' => 'icons_phone',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Number Phone 1',
            'name' => 'phone_number1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Number Phone 2 ',
            'name' => 'phone_number2',
            'type' => Input::TEXT,
            'required' => false,
        ],
		[
            'label' => 'Number Phone 3 ',
            'name' => 'phone_number3',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Icon Email',
            'name' => 'icons_email',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Email 1',
            'name' => 'email_footer1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Email 2',
            'name' => 'email_footer2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Icon Facebook',
            'name' => 'icons_facebook',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Link Facebook 1',
            'name' => 'link_facebook1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Facebook Name 1',
            'name' => 'name_facebook1',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Link Facebook 2',
            'name' => 'link_facebook2',
            'type' => Input::TEXT,
            'required' => false,
        ],
        [
            'label' => 'Facebook Name 2',
            'name' => 'name_facebook2',
            'type' => Input::TEXT,
            'required' => false,
        ],

    ],
]);

ThemeOptionManager::add([
    'name' => 'Link Image Poster Home Page',
    'fields' => [
        [
            'label' => 'Image Poster Link',
            'name' => 'image_poster_link',
            'type' => Input::TEXT,
            'required' => false,
        ],
    ],
]);

ContactFormManager::add([
    'name' => 'contact',
    'type' => Type::CONTACT,
    'style' => 'form-2',
    'email_enable' => true, /* default - false */
    'email_variables' => [
        'name' => 'NAME_FIELD',
        'email' => 'EMAIL_FIELD',
    ],
    'email_config' => [
        'domain_api' => 'http://sendmail.vicoders.com/',
        'mail_host' => 'HOST MAIL',
        'mail_port' => 'PORT',
        'mail_from' => 'EMAIL_FROM',
        'mail_name' => 'YOUR NAME',
        'mail_username' => 'EMAIL SEND',
        'mail_password' => 'EMAIL PASSWORD',
        'mail_encryption' => 'tls',
    ],
    'email_template' => [
        [
            'name' => 'Template 1',
            'path' => 'PATH_TO_HTML_TEMPLATE',
            'params' => [
                'name_author' => 'Garung 123',
                'post_title' => 'this is title 123',
                'content' => 'this is content 123',
                'link' => 'http://google.com',
                'site_url' => site_url(),
            ],
        ],
        [
            'name' => 'Template 2',
            'path' => 'PATH_TO_HTML_TEMPLATE',
            'params' => [
                'example_variable' => 'demo',
            ],
        ],
    ],
    'status' => [
        [
            'id' => 1,
            'name' => 'pending',
            'is_default' => true,
        ],
        [
            'id' => 2,
            'name' => 'confirmed',
            'is_default' => false,
        ],
        [
            'id' => 3,
            'name' => 'cancel',
            'is_default' => false,
        ],
        [
            'id' => 4,
            'name' => 'complete',
            'is_default' => false,
        ],
    ],
    'fields' => [
        [
            'label' => 'Full name *',
            'name' => 'Name', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'required' => true,
                'class' => 'name-input',
                'placeholder' => '',
            ],
        ],
        [
            'label' => 'Telephone number *',
            'name' => 'Number', // the key of option
            'type' => Input::NUMBER,
            'attributes' => [
                'required' => true,
                'class' => 'number-input',
                'placeholder' => '',
                'min' => 10,

            ],
        ],
        [
            'label' => 'Email *',
            'name' => 'Mail', // the key of option
            'type' => Input::EMAIL,
            'required' => true,
            'attributes' => [
                'class' => 'email-input',
                'placeholder' => '',
            ],
        ],
        [
            'label' => 'High school',
            'name' => 'School', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'required' => true,
                'class' => 'email-input',
                'placeholder' => '',
            ],
        ],
        [
            'label' => 'Parents name ',
            'name' => 'Name parents', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'required' => true,
                'class' => 'email-input',
                'placeholder' => '',
            ],
        ],
        [
            'label' => 'Parents Telephone number ',
            'name' => 'Number parents', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'required' => true,
                'class' => 'email-input',
                'placeholder' => '',
            ],
        ],

        [
            'value' => 'SUBMIT',
            'type' => Input::SUBMIT,
            'attributes' => [
                'class' => 'send',
            ],
        ],
    ],
]);

ContactFormManager::add([
    'name' => 'contact-info',
    'type' => Type::CONTACT,
    'style' => 'form-2',
    'email_enable' => true, /* default - false */
    'email_variables' => [
        'name' => 'NAME_FIELD',
        'email' => 'EMAIL_FIELD',
    ],
    'email_config' => [
        'domain_api' => 'http://sendmail.vicoders.com/',
        'mail_host' => 'HOST MAIL',
        'mail_port' => 'PORT',
        'mail_from' => 'EMAIL_FROM',
        'mail_name' => 'YOUR NAME',
        'mail_username' => 'EMAIL SEND',
        'mail_password' => 'EMAIL PASSWORD',
        'mail_encryption' => 'tls',
    ],
    'email_template' => [
        [
            'name' => 'Template 1',
            'path' => 'PATH_TO_HTML_TEMPLATE',
            'params' => [
                'name_author' => 'Garung 123',
                'post_title' => 'this is title 123',
                'content' => 'this is content 123',
                'link' => 'http://google.com',
                'site_url' => site_url(),
            ],
        ],
        [
            'name' => 'Template 2',
            'path' => 'PATH_TO_HTML_TEMPLATE',
            'params' => [
                'example_variable' => 'demo',
            ],
        ],
    ],
    'status' => [
        [
            'id' => 1,
            'name' => 'pending',
            'is_default' => true,
        ],
        [
            'id' => 2,
            'name' => 'confirmed',
            'is_default' => false,
        ],
        [
            'id' => 3,
            'name' => 'cancel',
            'is_default' => false,
        ],
        [
            'id' => 4,
            'name' => 'complete',
            'is_default' => false,
        ],
    ],
    'fields' => [
        [
            'label' => '',
            'name' => 'utm_link', // the key of option
            'type' => Input::TEXT,
            'required' => false,
            'attributes' => [
                'class' => 'utm_link custom-class',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Họ và tên *' : 'Full name *',
            'name' => 'full_name', // the key of option
            'type' => Input::TEXT,
            'required' => true,
            'attributes' => [
                'class' => 'name-input',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Trường học' : 'High school',
            'name' => 'high_school', // the key of option
            'type' => Input::TEXT,
            'required' => false,
            'attributes' => [
                'class' => 'email-input',
                'placeholder' => '',
            ],
        ],

        [
            'label' => pll_current_language('slug') === 'vi' ? 'Bạn đang sống ở thành phố nào?' : 'Which country do you live in?',
            'name' => 'live', // the key of option
            'type' => Input::TEXT,
            'required' => false,
            'attributes' => [
                'class' => 'email-input',
                'placeholder' => '',
            ],
        ],
        [
            'label' => pll_current_language('slug') === 'vi' ? 'Số điện thoại *' : 'Telephone number *',
            'name' => 'telephone_number', // the key of option
            'type' => Input::NUMBER,
            'required' => true,
            'attributes' => [
                'class' => 'number-input',
                'placeholder' => '',
                'min' => 10,

            ],
        ],
        [
            'label' => 'Email *',
            'name' => 'Email', // the key of option
            'required' => true,
            'type' => Input::TEXT,
            'attributes' => [
                'class' => 'email-input',
                'placeholder' => '',
            ],
        ],

        [
            'label' => pll_current_language('slug') === 'vi' ? 'Ngày tháng năm sinh *' : 'Date of birth *',
            'name' => 'day', // the key of option
            'type' => Input::NUMBER,
            'required' => true,
            'attributes' => [
                'class' => 'day',
                'placeholder' => 'Day',
                'min' => '1',
                'max' => '31',
            ],
        ],
        [
            'label' => '',
            'name' => 'Month', // the key of option
            'type' => Input::NUMBER,
            'required' => true,
            'attributes' => [
                'class' => 'birth',
                'placeholder' => 'Month',
                'min' => '1',
                'max' => '12',
            ],
        ],
        [
            'label' => '',
            'name' => 'Year', // the key of option
            'type' => Input::NUMBER,
            'required' => true,
            'attributes' => [
                'class' => 'birth',
                'placeholder' => 'Year',
                'min' => '1900',
            ],
        ],

        [
            'label' => pll_current_language('slug') === 'vi' ? 'Bạn đang quan tâm đến khóa học nào?' : 'Which course are you interested in?',
            'name' => 'care', // the key of option
            'type' => Input::SELECT,

            'attributes' => [
                'required' => true,
                'class' => 'email-input',
                'placeholder' => '',
            ],
            'options' => [
                [
                    'label' => pll_current_language('slug') === 'vi' ? 'Công nghệ phần mềm' : 'Software Technology',
                    'selected' => true,
                    'value' => pll_current_language('slug') === 'vi' ? 'Cong_nghe_phan_mem' : 'Software_Technology',
                ],
                [
                    'label' => pll_current_language('slug') === 'vi' ? 'Quản trị hệ thống' : 'System management',
                    'selected' => false,
                    'value' => pll_current_language('slug') === 'vi' ? 'Quan_tri_he_thong' : 'System_management',
                ],
                [
                    'label' => pll_current_language('slug') === 'vi' ? 'Quản trị kinh doanh' : 'Business administration',
                    'selected' => false,
                    'value' => pll_current_language('slug') === 'vi' ? 'Quan_tri_kinh_doanh' : 'Business_administration',
                ],
                [
                    'label' => pll_current_language('slug') === 'vi' ? 'Marketing' : 'Marketing',
                    'selected' => false,
                    'value' => pll_current_language('slug') === 'vi' ? 'Marketing' : 'Marketing',
                ],
                [
                    'label' => pll_current_language('slug') === 'vi' ? 'Kinh doanh quốc tế' : 'International bussiness',
                    'selected' => false,
                    'value' => pll_current_language('slug') === 'vi' ? 'Kinh_doanh_quoc_te' : 'International_bussiness',
                ],
                [
                    'label' => pll_current_language('slug') === 'vi' ? 'Truyền thông đa phương tiện' : 'Multimedia communications',
                    'selected' => false,
                    'value' => pll_current_language('slug') === 'vi' ? 'Truyen_thong_da_phuong_tien' : 'Multimedia_communications',
                ],
            ],
        ],

        [
            'label' => '',
            'name' => 'location', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'required' => false,
                'class' => 'email-input none_location',
                'placeholder' => '',
                "value = '$location'",
            ],
        ],
        [
            'label' => '',
            'name' => 'Duration', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'required' => false,
                'class' => 'email-input none_duration',
                'placeholder' => '',
                "value = '$duration'",
            ],
        ],
        [
            'label' => '',
            'name' => 'Type', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'required' => false,
                'class' => 'email-input none_type',
                'placeholder' => '',
                "value = '$type'",
            ],
        ],

        [
            'label' => '',
            'name' => 'Take_time', // the key of option
            'type' => Input::TEXT,
            'attributes' => [
                'required' => false,
                'class' => 'email-input none_take_time',
                'placeholder' => '',
                "value = '$take_time'",
            ],
        ],

        [
            'value' => pll_current_language('slug') === 'vi' ? 'GỬI ĐI' : 'SUBMIT',
            'type' => Input::SUBMIT,
            'attributes' => [
                'class' => 'send contact-submit',
            ],
        ],
    ],
]);

add_action('admin_post_nopriv_contact_info', 'saveInfo');

add_action('admin_post_contact_info', 'saveInfo');

function saveInfo()
{
    $_SESSION['contactInfo'] = $_POST;
    wp_redirect(site_url($_POST['lang'] === 'vi' ? 'lien-he' : 'contact-info'));
}

if (!function_exists('sut_language_switcher')) {
    function sut_language_switcher()
    {
        $output = "
          <div class=\"lang-switcher\">
              <a href=\"" . get_bloginfo('wpurl') . "/\" class=\"" . (pll_current_language('slug') !== 'vi' ?: 'active') . "\">
              <img src='/wp-content/themes/swinburne/resources/assets/images/Flag_of_Vietnam.jpg'>
              </a>
             
          </div>
        ";
		  $output2 = "
          <div class=\"lang-switcher\">
              <a href=\"" . get_bloginfo('wpurl') . "/\" class=\"" . (pll_current_language('slug') !== 'vi' ?: 'active') . "\">
              <img src='/wp-content/themes/swinburne/resources/assets/images/Flag_of_Vietnam.jpg'>
              </a>
              <a href=\"" . get_bloginfo('wpurl') . "/en/\" class=\"" . (pll_current_language('slug') !== 'en' ?: 'active') . "\">
                 <img src='/wp-content/themes/swinburne/resources/assets/images/co-vuong-quoc-anh.jpg'>
              </a>
          </div>
        ";

        echo $output2;
    }

    add_action('sut_language_switcher', 'sut_language_switcher');
}

// error_log('testing if error log is working');

// define the wp_mail_failed callback
function action_wp_mail_failed($wp_error)
{
    return error_log(print_r($wp_error, true));
}

// add the action
add_action('wp_mail_failed', 'action_wp_mail_failed', 10, 1);
add_action('contact_form_submitted', function ($data) {

    // Log::info(['data' => $data]);

    $all_data = ['data' => $data];

    $data_form = $all_data['data']['request'];
    // echo $data_form['full_name'];
    // var_dump($data_form);
    // die();

    $get_full_name = $data_form['full_name'];
    $mobile_number = $data_form['telephone_number'];
    $email_address = $data_form['Email'];
    $date_of_birth = [
        $data_form['day'],
        $data_form['Month'],
        $data_form['Year'],

    ];
    $date_of_birth_text = $data_form['day'] . "/" . $data_form['Month'] . "/" . $data_form['Year'];

    $get_country = $data_form['live'];
    $get_course = $data_form['care'];
    $get_question = $data_form['question'];
    $get_school = $data_form['high_school'];
    $get_parent_name = $data_form['parents_name'];
    $get_parent_number = $data_form['Parent_telephone_number'];

    $to = '';
    $subject = 'Đăng ký tìm hiểu thông tin tại Swinburne Việt Nam';
    $headers = array('Content-Type: text/html; charset=UTF-8');

    $body = array($get_full_name, $mobile_number, $email_address, $date_of_birth, $get_country, $get_course, $get_question, $get_school, $get_parent_name, $get_parent_number);

    $body_text = "Dear Swinburne Viet Nam, <br>" . "Tôi muốn được tư vấn và tìm hiểu thêm thông tin về Swinburne Việt Nam. Dưới đây là một số thông tin của tôi : <br> Fullname : " . $body['0'] . "<br>" . "Moile Number :" . $body['1'] . "<br>" . "Email Address :" . $body['2'] . "<br>" . "Date of birth:" . $date_of_birth_text . "<br>" . "Which country do you live in ? :" . $body['4'] . "<br>" . "Which course are you interested in? :" . $body['5'] . "<br>" . "Your Question :" . $body['6'] . "<br>" . "High school :" . $body['7'] . "<br>" . "Parent’s name :" . $body['8'] . "<br>" . "Parent’s Teletphone Number :" . $body['9'] . "<br>" . "Tôi hy vọng sớm nhận được sự tư vấn từ Swinburne Việt Nam.<br>" . "Trân trọng!";

    wp_mail($to, $subject, $body_text, $headers);
});
