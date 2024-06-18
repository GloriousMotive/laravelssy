<?php

namespace App\Constants;

class ConfigConstants
{
    public const OVERRIDABLE_CONFIGS = [  // correspond to laravel config keys
        'app.name',
        'app.description',
        'app.support_email',
        'app.date_format',
        'app.datetime_format',
        'app.default_currency',
        'app.google_tracking_id',
        'app.posthog_html_snippet',
        'app.payment.proration_enabled',
        'mail.default',
        'mail.from.name',
        'mail.from.address',
        'services.ses.key',
        'services.ses.secret',
        'services.ses.region',
        'services.mailgun.domain',
        'services.mailgun.secret',
        'services.mailgun.endpoint',
        'services.facebook.client_id',
        'services.facebook.client_secret',
        'services.google.client_id',
        'services.google.client_secret',
        'services.twitter-oauth-2.client_id',
        'services.twitter-oauth-2.client_secret',
        'services.bitbucket.client_id',
        'services.bitbucket.client_secret',
        'services.github.client_id',
        'services.github.client_secret',
        'services.linkedin.client_id',
        'services.linkedin.client_secret',
        'services.gitlab.client_id',
        'services.gitlab.client_secret',
        'services.paddle.vendor_id',
        'services.paddle.client_side_token',
        'services.paddle.vendor_auth_code',
        'services.paddle.webhook_secret',
        'services.paddle.is_sandbox',
        'services.stripe.secret_key',
        'services.stripe.publishable_key',
        'services.stripe.webhook_signing_secret',
        'services.lemon-squeezy.api_key',
        'services.lemon-squeezy.store_id',
        'services.lemon-squeezy.signing_secret',
        'services.lemon-squeezy.is_test_mode',
        'services.postmark.token',
        'services.resend.key',
        'app.customer_dashboard.show_subscriptions',
        'app.customer_dashboard.show_orders',
        'app.customer_dashboard.show_transactions',
        'app.social_links.facebook',
        'app.social_links.x',
        'app.social_links.linkedin',
        'app.social_links.github',
        'app.social_links.instagram',
        'app.social_links.youtube',
        'app.social_links.discord',
        'mail.mailers.smtp.host',
        'mail.mailers.smtp.port',
        'mail.mailers.smtp.username',
        'mail.mailers.smtp.password',
        'app.roadmap_enabled',
        'app.recaptcha_enabled',
        'recaptcha.api_site_key',
        'recaptcha.api_secret_key',
        'app.multiple_subscriptions_enabled',

        // Open Graphy
        'open-graphy.enabled',
        'open-graphy.template',
        'open-graphy.logo.enabled',
        'open-graphy.logo.location',
        'open-graphy.screenshot.enabled',
        'open-graphy.template_settings.strings.background',
        'open-graphy.template_settings.strings.stroke_color',
        'open-graphy.template_settings.strings.stroke_width',
        'open-graphy.template_settings.strings.text_color',
        'open-graphy.template_settings.stripes.start_color',
        'open-graphy.template_settings.stripes.end_color',
        'open-graphy.template_settings.stripes.text_color',
        'open-graphy.template_settings.sunny.start_color',
        'open-graphy.template_settings.sunny.end_color',
        'open-graphy.template_settings.sunny.text_color',
        'open-graphy.template_settings.verticals.start_color',
        'open-graphy.template_settings.verticals.mid_color',
        'open-graphy.template_settings.verticals.end_color',
        'open-graphy.template_settings.verticals.text_color',
        'open-graphy.template_settings.nodes.background',
        'open-graphy.template_settings.nodes.node_color',
        'open-graphy.template_settings.nodes.edge_color',
        'open-graphy.template_settings.nodes.text_color',

        // Invoices
        'invoices.enabled',
        'invoices.serial_number.series',
        'invoices.seller.attributes.name',
        'invoices.seller.attributes.address',
        'invoices.seller.attributes.code',
        'invoices.seller.attributes.vat',
        'invoices.seller.attributes.phone',
    ];
}
