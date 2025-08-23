---
title: Controller Examples
description: Practical controller examples in Antonella Framework
extends: _layouts.documentation
section: content
---

# Controller Examples

Practical controller examples in Antonella Framework with real-world use cases, aligned with the new flow: hooks are registered exclusively from `Config.php` and controller methods must be static or properly referenced from the configuration.

## Basic Contact Controller

A simple controller that displays a contact form and processes the submission via AJAX.

```php
<?php

namespace YourPlugin\Controllers;

class ContactController
{
    // Hook registration is done in config.php (do not register hooks here)
    
    public static function display_contact_form($atts)
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
    
    public static function handle_contact_submission()
    {
        // Verify nonce
        if (!wp_verify_nonce($_POST['nonce'], 'contact_form_nonce')) {
            wp_die('Security check failed');
        }
        
        // Sanitize input
        $name = sanitize_text_field($_POST['name'] ?? '');
        $email = sanitize_email($_POST['email'] ?? '');
        $phone = sanitize_text_field($_POST['phone'] ?? '');
        $message = sanitize_textarea_field($_POST['message'] ?? '');
        
        // Basic validation
        if (empty($name) || empty($email) || empty($message)) {
            wp_send_json_error('Please complete the required fields.');
        }
        
        // Send email
        $to = get_option('admin_email');
        $subject = 'New contact message';
        $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
        
        if (wp_mail($to, $subject, $body)) {
            wp_send_json_success('Thanks! Your message has been sent.');
        } else {
            wp_send_json_error('An error occurred while sending your message.');
        }
    }
}
```

Registration in Config.php:

```php
public $add_action = [
    ['wp_ajax_submit_contact', __NAMESPACE__.'\\Controllers\\ContactController::handle_contact_submission'],
    ['wp_ajax_nopriv_submit_contact', __NAMESPACE__.'\\Controllers\\ContactController::handle_contact_submission'],
];

public $shortcodes = [
    'contact_form' => [
        'callback' => __NAMESPACE__.'\\Controllers\\ContactController@display_contact_form',
        'description' => 'Display contact form',
    ],
];
```

## AJAX Posts Loader Controller

Dynamically loads content via AJAX.

```php
<?php

namespace YourPlugin\Controllers;

class AjaxController
{
    // Hook registration is done in config.php (do not register hooks here)
    
    public static function enqueue_scripts()
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
    
    public static function load_posts()
    {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'load_posts_nonce')) {
            wp_send_json_error('Security check failed');
        }
        
        $page = intval($_POST['page'] ?? 1);
        $posts_per_page = intval($_POST['posts_per_page'] ?? 5) ?: 5;
        $category = sanitize_text_field($_POST['category'] ?? '');
        
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

Registration in Config.php:

```php
public $add_action = [
    ['wp_ajax_load_posts', __NAMESPACE__.'\\Controllers\\AjaxController::load_posts'],
    ['wp_ajax_nopriv_load_posts', __NAMESPACE__.'\\Controllers\\AjaxController::load_posts'],
    ['wp_enqueue_scripts', __NAMESPACE__.'\\Controllers\\AjaxController::enqueue_scripts'],
];
```

## REST API Controller

Defines custom endpoints for the REST API.

```php
<?php

namespace YourPlugin\Controllers;
use WP_REST_Request;
use WP_REST_Response;

class ApiController
{
    // Hook registration is done in config.php (do not register hooks here)
    
    public static function register_routes()
    {
        register_rest_route('your-plugin/v1', '/products', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'get_products'],
            'permission_callback' => '__return_true'
        ]);
        
        register_rest_route('your-plugin/v1', '/products/(?P<id>\\d+)', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'get_product'],
            'permission_callback' => '__return_true'
        ]);
        
        register_rest_route('your-plugin/v1', '/products', [
            'methods' => 'POST',
            'callback' => [__CLASS__, 'create_product'],
            'permission_callback' => [__CLASS__, 'check_permissions']
        ]);
    }
    
    public static function get_products(WP_REST_Request $request)
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
    
    public static function get_product(WP_REST_Request $request)
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
    
    public static function create_product(WP_REST_Request $request)
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
            return new WP_REST_Response(['error' => 'Could not create product'], 500);
        }
        
        update_post_meta($post_id, 'price', $price);
        update_post_meta($post_id, 'product_category', $category);
        
        return new WP_REST_Response([
            'id' => $post_id,
            'message' => 'Product created successfully'
        ], 201);
    }
    
    public static function check_permissions()
    {
        return current_user_can('manage_options');
    }
}
```

Registration in Config.php:

```php
public $add_action = [
    ['rest_api_init', __NAMESPACE__.'\\Controllers\\ApiController::register_routes'],
];
```

## Settings Controller

Handles plugin settings in the admin area.

```php
<?php

namespace YourPlugin\Controllers;

class SettingsController
{
    private $option_name = 'your_plugin_settings';
    // Hook registration is done in config.php (do not register hooks here)
    
    public static function add_admin_menu()
    {
        add_options_page(
            'Your Plugin Settings',
            'Your Plugin',
            'manage_options',
            'your-plugin-settings',
            [__CLASS__, 'settings_page']
        );
    }
    
    public static function settings_init()
    {
        register_setting('your_plugin_settings', 'your_plugin_settings');
        
        add_settings_section(
            'general_section',
            'General Settings',
            function () { echo '<p>Configure the general settings.</p>'; },
            'your-plugin-settings'
        );
        
        add_settings_field(
            'api_key',
            'API Key',
            [__CLASS__, 'api_key_render'],
            'your-plugin-settings',
            'general_section'
        );
        
        add_settings_field(
            'enable_feature',
            'Enable Feature',
            [__CLASS__, 'enable_feature_render'],
            'your-plugin-settings',
            'general_section'
        );
    }
    
    public static function api_key_render()
    {
        $options = get_option('your_plugin_settings');
        ?>
        <input type="text" name="your_plugin_settings[api_key]" 
               value="<?php echo isset($options['api_key']) ? esc_attr($options['api_key']) : ''; ?>" 
               class="regular-text" />
        <p class="description">Enter your API key.</p>
        <?php
    }
    
    public static function enable_feature_render()
    {
        $options = get_option('your_plugin_settings');
        ?>
        <input type="checkbox" name="your_plugin_settings[enable_feature]" 
               value="1" <?php checked(isset($options['enable_feature']) ? $options['enable_feature'] : 0, 1); ?> />
        <label>Enable this feature</label>
        <?php
    }
    
    public static function settings_page()
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
    
    public static function save_settings()
    {
        if (!wp_verify_nonce($_POST['nonce'] ?? '', 'save_settings_nonce')) {
            wp_send_json_error('Security check failed');
        }
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Insufficient permissions');
        }
        
        $settings = [
            'api_key' => sanitize_text_field($_POST['api_key'] ?? ''),
            'enable_feature' => isset($_POST['enable_feature']) ? 1 : 0
        ];
        
        update_option('your_plugin_settings', $settings);
        
        wp_send_json_success('Settings saved successfully');
    }
}
```

Registration in Config.php:

```php
public $add_action = [
    ['admin_menu', __NAMESPACE__.'\\Controllers\\SettingsController::add_admin_menu'],
    ['admin_init', __NAMESPACE__.'\\Controllers\\SettingsController::settings_init'],
    ['wp_ajax_save_settings', __NAMESPACE__.'\\Controllers\\SettingsController::save_settings'],
];
```

## Shortcodes Controller

Handles multiple shortcodes from a single controller.

```php
<?php

namespace YourPlugin\Controllers;

class ShortcodeController
{
    // Shortcodes are registered in config.php (do not register here)
    
    public static function product_grid_shortcode($atts)
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
    
    public static function testimonials_shortcode($atts)
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
    
    public static function pricing_table_shortcode($atts)
    {
        $atts = shortcode_atts([
            'plans' => '',
            'currency' => '$',
            'highlight' => ''
        ], $atts);
        
        if (empty($atts['plans'])) {
            return '<p>No plans specified.</p>';
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

Registration in Config.php:

```php
public $shortcodes = [
    'product_grid' => [
        'callback' => __NAMESPACE__.'\\Controllers\\ShortcodeController@product_grid_shortcode',
    ],
    'testimonials' => [
        'callback' => __NAMESPACE__.'\\Controllers\\ShortcodeController@testimonials_shortcode',
    ],
    'pricing_table' => [
        'callback' => __NAMESPACE__.'\\Controllers\\ShortcodeController@pricing_table_shortcode',
    ],
];
```

## Next Steps

- Learn about [working with views](/docs/working-with-views)
- Explore [database operations](/docs/database-operations)
- Review [API examples](/docs/api-examples)
- Check [testing strategies](/docs/localhost-testing)

These examples demonstrate the flexibility and power of Antonella Framework controllers. Use them as a starting point for your implementations! 🚀
