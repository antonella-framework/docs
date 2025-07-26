---
title: Controller Examples
description: Practical examples of controllers in Antonella Framework
extends: _layouts.documentation
section: content
---

# Controller Examples

Practical examples of controllers in Antonella Framework with real-world use cases.

## Basic Controller Example

Here's a simple controller that handles a contact form:

```php
<?php

namespace YourPlugin\Controllers;

use YourPlugin\Core\Controller;

class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    public function init()
    {
        add_action('wp_ajax_submit_contact', [$this, 'handle_contact_submission']);
        add_action('wp_ajax_nopriv_submit_contact', [$this, 'handle_contact_submission']);
        add_shortcode('contact_form', [$this, 'display_contact_form']);
    }
    
    public function display_contact_form($atts)
    {
        $atts = shortcode_atts([
            'title' => 'Contact Us',
            'show_phone' => 'yes'
        ], $atts);
        
        ob_start();
        ?>
        <div class="contact-form-wrapper">
            <h3><?php echo esc_html($atts['title']); ?></h3>
            <form id="contact-form" method="post">
                <p>
                    <label for="contact-name">Name *</label>
                    <input type="text" id="contact-name" name="name" required>
                </p>
                <p>
                    <label for="contact-email">Email *</label>
                    <input type="email" id="contact-email" name="email" required>
                </p>
                <?php if ($atts['show_phone'] === 'yes'): ?>
                <p>
                    <label for="contact-phone">Phone</label>
                    <input type="tel" id="contact-phone" name="phone">
                </p>
                <?php endif; ?>
                <p>
                    <label for="contact-message">Message *</label>
                    <textarea id="contact-message" name="message" rows="5" required></textarea>
                </p>
                <p>
                    <button type="submit">Send Message</button>
                </p>
                <?php wp_nonce_field('contact_form_nonce', 'nonce'); ?>
            </form>
        </div>
        <?php
        return ob_get_clean();
    }
    
    public function handle_contact_submission()
    {
        // Verify nonce
        if (!wp_verify_nonce($_POST['nonce'], 'contact_form_nonce')) {
            wp_die('Security check failed');
        }
        
        // Sanitize input
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);
        $message = sanitize_textarea_field($_POST['message']);
        
        // Validate required fields
        if (empty($name) || empty($email) || empty($message)) {
            wp_send_json_error('Please fill in all required fields.');
        }
        
        // Send email
        $to = get_option('admin_email');
        $subject = 'New Contact Form Submission';
        $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
        
        if (wp_mail($to, $subject, $body)) {
            wp_send_json_success('Thank you! Your message has been sent.');
        } else {
            wp_send_json_error('Sorry, there was an error sending your message.');
        }
    }
}
```

## AJAX Controller Example

A controller that handles AJAX requests for dynamic content loading:

```php
<?php

namespace YourPlugin\Controllers;

use YourPlugin\Core\Controller;

class AjaxController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    public function init()
    {
        add_action('wp_ajax_load_posts', [$this, 'load_posts']);
        add_action('wp_ajax_nopriv_load_posts', [$this, 'load_posts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }
    
    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'ajax-loader',
            plugin_dir_url(__FILE__) . '../assets/js/ajax-loader.js',
            ['jquery'],
            '1.0.0',
            true
        );
        
        wp_localize_script('ajax-loader', 'ajax_object', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('load_posts_nonce')
        ]);
    }
    
    public function load_posts()
    {
        // Verify nonce
        if (!wp_verify_nonce($_POST['nonce'], 'load_posts_nonce')) {
            wp_send_json_error('Security check failed');
        }
        
        $page = intval($_POST['page']);
        $posts_per_page = intval($_POST['posts_per_page']) ?: 5;
        $category = sanitize_text_field($_POST['category']);
        
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $posts_per_page,
            'paged' => $page,
            'post_status' => 'publish'
        ];
        
        if (!empty($category)) {
            $args['category_name'] = $category;
        }
        
        $query = new \WP_Query($args);
        
        if ($query->have_posts()) {
            $posts = [];
            while ($query->have_posts()) {
                $query->the_post();
                $posts[] = [
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'excerpt' => get_the_excerpt(),
                    'permalink' => get_permalink(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium')
                ];
            }
            wp_reset_postdata();
            
            wp_send_json_success([
                'posts' => $posts,
                'has_more' => $page < $query->max_num_pages
            ]);
        } else {
            wp_send_json_error('No posts found');
        }
    }
}
```

## REST API Controller Example

A controller that creates custom REST API endpoints:

```php
<?php

namespace YourPlugin\Controllers;

use YourPlugin\Core\Controller;
use WP_REST_Request;
use WP_REST_Response;

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    public function init()
    {
        add_action('rest_api_init', [$this, 'register_routes']);
    }
    
    public function register_routes()
    {
        register_rest_route('your-plugin/v1', '/products', [
            'methods' => 'GET',
            'callback' => [$this, 'get_products'],
            'permission_callback' => '__return_true'
        ]);
        
        register_rest_route('your-plugin/v1', '/products/(?P<id>\d+)', [
            'methods' => 'GET',
            'callback' => [$this, 'get_product'],
            'permission_callback' => '__return_true'
        ]);
        
        register_rest_route('your-plugin/v1', '/products', [
            'methods' => 'POST',
            'callback' => [$this, 'create_product'],
            'permission_callback' => [$this, 'check_permissions']
        ]);
    }
    
    public function get_products(WP_REST_Request $request)
    {
        $page = $request->get_param('page') ?: 1;
        $per_page = $request->get_param('per_page') ?: 10;
        $category = $request->get_param('category');
        
        $args = [
            'post_type' => 'product',
            'posts_per_page' => $per_page,
            'paged' => $page,
            'post_status' => 'publish'
        ];
        
        if ($category) {
            $args['meta_query'] = [
                [
                    'key' => 'product_category',
                    'value' => $category,
                    'compare' => '='
                ]
            ];
        }
        
        $query = new \WP_Query($args);
        $products = [];
        
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $products[] = [
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'content' => get_the_content(),
                    'price' => get_post_meta(get_the_ID(), 'price', true),
                    'category' => get_post_meta(get_the_ID(), 'product_category', true),
                    'image' => get_the_post_thumbnail_url(get_the_ID(), 'full')
                ];
            }
            wp_reset_postdata();
        }
        
        return new WP_REST_Response([
            'products' => $products,
            'total' => $query->found_posts,
            'pages' => $query->max_num_pages
        ], 200);
    }
    
    public function get_product(WP_REST_Request $request)
    {
        $id = $request->get_param('id');
        $post = get_post($id);
        
        if (!$post || $post->post_type !== 'product') {
            return new WP_REST_Response(['error' => 'Product not found'], 404);
        }
        
        return new WP_REST_Response([
            'id' => $post->ID,
            'title' => $post->post_title,
            'content' => $post->post_content,
            'price' => get_post_meta($post->ID, 'price', true),
            'category' => get_post_meta($post->ID, 'product_category', true),
            'image' => get_the_post_thumbnail_url($post->ID, 'full')
        ], 200);
    }
    
    public function create_product(WP_REST_Request $request)
    {
        $title = sanitize_text_field($request->get_param('title'));
        $content = wp_kses_post($request->get_param('content'));
        $price = floatval($request->get_param('price'));
        $category = sanitize_text_field($request->get_param('category'));
        
        if (empty($title)) {
            return new WP_REST_Response(['error' => 'Title is required'], 400);
        }
        
        $post_id = wp_insert_post([
            'post_title' => $title,
            'post_content' => $content,
            'post_type' => 'product',
            'post_status' => 'publish'
        ]);
        
        if (is_wp_error($post_id)) {
            return new WP_REST_Response(['error' => 'Failed to create product'], 500);
        }
        
        // Save meta fields
        update_post_meta($post_id, 'price', $price);
        update_post_meta($post_id, 'product_category', $category);
        
        return new WP_REST_Response([
            'id' => $post_id,
            'message' => 'Product created successfully'
        ], 201);
    }
    
    public function check_permissions()
    {
        return current_user_can('manage_options');
    }
}
```

## Settings Controller Example

A controller for managing plugin settings:

```php
<?php

namespace YourPlugin\Controllers;

use YourPlugin\Core\Controller;

class SettingsController extends Controller
{
    private $option_name = 'your_plugin_settings';
    
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    public function init()
    {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'settings_init']);
        add_action('wp_ajax_save_settings', [$this, 'save_settings']);
    }
    
    public function add_admin_menu()
    {
        add_options_page(
            'Your Plugin Settings',
            'Your Plugin',
            'manage_options',
            'your-plugin-settings',
            [$this, 'settings_page']
        );
    }
    
    public function settings_init()
    {
        register_setting('your_plugin_settings', $this->option_name);
        
        add_settings_section(
            'general_section',
            'General Settings',
            [$this, 'general_section_callback'],
            'your-plugin-settings'
        );
        
        add_settings_field(
            'api_key',
            'API Key',
            [$this, 'api_key_render'],
            'your-plugin-settings',
            'general_section'
        );
        
        add_settings_field(
            'enable_feature',
            'Enable Feature',
            [$this, 'enable_feature_render'],
            'your-plugin-settings',
            'general_section'
        );
    }
    
    public function api_key_render()
    {
        $options = get_option($this->option_name);
        ?>
        <input type="text" name="<?php echo $this->option_name; ?>[api_key]" 
               value="<?php echo isset($options['api_key']) ? esc_attr($options['api_key']) : ''; ?>" 
               class="regular-text" />
        <p class="description">Enter your API key here.</p>
        <?php
    }
    
    public function enable_feature_render()
    {
        $options = get_option($this->option_name);
        ?>
        <input type="checkbox" name="<?php echo $this->option_name; ?>[enable_feature]" 
               value="1" <?php checked(isset($options['enable_feature']) ? $options['enable_feature'] : 0, 1); ?> />
        <label>Enable this feature</label>
        <?php
    }
    
    public function general_section_callback()
    {
        echo '<p>Configure the general settings for your plugin.</p>';
    }
    
    public function settings_page()
    {
        ?>
        <div class="wrap">
            <h1>Your Plugin Settings</h1>
            <form action="options.php" method="post">
                <?php
                settings_fields('your_plugin_settings');
                do_settings_sections('your-plugin-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
    
    public function save_settings()
    {
        if (!wp_verify_nonce($_POST['nonce'], 'save_settings_nonce')) {
            wp_send_json_error('Security check failed');
        }
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Insufficient permissions');
        }
        
        $settings = [
            'api_key' => sanitize_text_field($_POST['api_key']),
            'enable_feature' => isset($_POST['enable_feature']) ? 1 : 0
        ];
        
        update_option($this->option_name, $settings);
        
        wp_send_json_success('Settings saved successfully');
    }
    
    public function get_setting($key, $default = '')
    {
        $options = get_option($this->option_name);
        return isset($options[$key]) ? $options[$key] : $default;
    }
}
```

## Shortcode Controller Example

A controller that handles multiple shortcodes:

```php
<?php

namespace YourPlugin\Controllers;

use YourPlugin\Core\Controller;

class ShortcodeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    public function init()
    {
        add_shortcode('product_grid', [$this, 'product_grid_shortcode']);
        add_shortcode('testimonials', [$this, 'testimonials_shortcode']);
        add_shortcode('pricing_table', [$this, 'pricing_table_shortcode']);
    }
    
    public function product_grid_shortcode($atts)
    {
        $atts = shortcode_atts([
            'limit' => 6,
            'category' => '',
            'columns' => 3,
            'show_price' => 'yes'
        ], $atts);
        
        $args = [
            'post_type' => 'product',
            'posts_per_page' => intval($atts['limit']),
            'post_status' => 'publish'
        ];
        
        if (!empty($atts['category'])) {
            $args['meta_query'] = [
                [
                    'key' => 'product_category',
                    'value' => $atts['category'],
                    'compare' => '='
                ]
            ];
        }
        
        $query = new \WP_Query($args);
        
        if (!$query->have_posts()) {
            return '<p>No products found.</p>';
        }
        
        ob_start();
        ?>
        <div class="product-grid columns-<?php echo esc_attr($atts['columns']); ?>">
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <div class="product-item">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="product-image">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="product-content">
                        <h3><?php the_title(); ?></h3>
                        <div class="product-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <?php if ($atts['show_price'] === 'yes'): ?>
                            <div class="product-price">
                                $<?php echo esc_html(get_post_meta(get_the_ID(), 'price', true)); ?>
                            </div>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="product-link">View Details</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }
    
    public function testimonials_shortcode($atts)
    {
        $atts = shortcode_atts([
            'limit' => 3,
            'show_rating' => 'yes',
            'layout' => 'grid'
        ], $atts);
        
        $testimonials = get_posts([
            'post_type' => 'testimonial',
            'posts_per_page' => intval($atts['limit']),
            'post_status' => 'publish'
        ]);
        
        if (empty($testimonials)) {
            return '<p>No testimonials found.</p>';
        }
        
        ob_start();
        ?>
        <div class="testimonials-wrapper layout-<?php echo esc_attr($atts['layout']); ?>">
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-item">
                    <div class="testimonial-content">
                        <?php echo wpautop($testimonial->post_content); ?>
                    </div>
                    <div class="testimonial-author">
                        <strong><?php echo esc_html($testimonial->post_title); ?></strong>
                        <?php
                        $company = get_post_meta($testimonial->ID, 'company', true);
                        if ($company): ?>
                            <span class="company"><?php echo esc_html($company); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if ($atts['show_rating'] === 'yes'): ?>
                        <div class="testimonial-rating">
                            <?php
                            $rating = intval(get_post_meta($testimonial->ID, 'rating', true));
                            for ($i = 1; $i <= 5; $i++):
                                echo $i <= $rating ? '★' : '☆';
                            endfor;
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }
    
    public function pricing_table_shortcode($atts)
    {
        $atts = shortcode_atts([
            'plans' => '',
            'currency' => '$',
            'highlight' => ''
        ], $atts);
        
        if (empty($atts['plans'])) {
            return '<p>No pricing plans specified.</p>';
        }
        
        $plan_ids = explode(',', $atts['plans']);
        $plans = get_posts([
            'post_type' => 'pricing_plan',
            'post__in' => array_map('intval', $plan_ids),
            'orderby' => 'post__in'
        ]);
        
        ob_start();
        ?>
        <div class="pricing-table">
            <?php foreach ($plans as $plan): ?>
                <div class="pricing-plan <?php echo $plan->ID == $atts['highlight'] ? 'highlighted' : ''; ?>">
                    <h3 class="plan-name"><?php echo esc_html($plan->post_title); ?></h3>
                    <div class="plan-price">
                        <span class="currency"><?php echo esc_html($atts['currency']); ?></span>
                        <span class="amount"><?php echo esc_html(get_post_meta($plan->ID, 'price', true)); ?></span>
                        <span class="period">/<?php echo esc_html(get_post_meta($plan->ID, 'period', true)); ?></span>
                    </div>
                    <div class="plan-features">
                        <?php echo wpautop($plan->post_content); ?>
                    </div>
                    <div class="plan-action">
                        <a href="<?php echo esc_url(get_post_meta($plan->ID, 'signup_url', true)); ?>" 
                           class="plan-button">Choose Plan</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}
```

## Next Steps

- Learn about [working with views](working-with-views)
- Explore [database operations](database-operations)
- Check out [API examples](api-examples)
- Review [testing strategies](localhost-testing)

These examples demonstrate the flexibility and power of Antonella Framework controllers. Use them as starting points for your own implementations! 🚀
