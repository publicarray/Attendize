<?php

namespace App\Services\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Policy as BasePolicy;

class Policy extends BasePolicy
{
    public function configure()
    {
        $this
            ->addGeneralDirectives()
            ->addDirectivesForBootstrap()
            ->addDirectivesForGoogleFonts()
            ->addDirectivesForGoogleMaps()
            ->addDirectivesForGoogleAnalytics()
            ->addDirectivesForTwitter()
            ->addDirectivesForStripe()
            //->addDirectivesForSRI()
            ->addDirectivesForCdnjs();
    }


    protected function addGeneralDirectives(): self
    {
        return $this
            ->addDirective(Directive::BASE, 'self')
            // ->addNonceForDirective(Directive::SCRIPT)
            ->addDirective(Directive::SCRIPT, [
                'self',
                'unsafe-inline'
            ])
            ->addDirective(Directive::STYLE, [
                'self',
                'unsafe-inline',
            ])
            ->addDirective(Directive::FONT, ['self', 'data:'])
            ->addDirective(Directive::FORM_ACTION, [
                'self',
            ])
            ->addDirective(Directive::IMG, [
                '*',
                'unsafe-inline',
                'data:',
            ])
            ->addDirective(Directive::OBJECT, 'none');
    }

    protected function addDirectivesForBootstrap(): self
    {
        return $this
            ->addDirective(Directive::FONT, ['*.bootstrapcdn.com'])
            ->addDirective(Directive::SCRIPT, ['*.bootstrapcdn.com'])
            ->addDirective(Directive::STYLE, ['*.bootstrapcdn.com']);
    }

    protected function addDirectivesForGoogleFonts(): self
    {
        return $this
            ->addDirective(Directive::FONT, 'fonts.gstatic.com')
            ->addDirective(Directive::SCRIPT, 'fonts.googleapis.com')
            ->addDirective(Directive::STYLE, 'fonts.googleapis.com');
    }

    protected function addDirectivesForGoogleMaps(): self
    {
        return $this
            ->addDirective(Directive::FRAME, [
                'https://maps.google.com',
                'https://www.google.com'
            ])
            ->addDirective(Directive::SCRIPT, 'https://maps.googleapis.com/maps');
    }

    protected function addDirectivesForGoogleAnalytics(): self
    {
        return $this->addDirective(Directive::SCRIPT, '*.google-analytics.com');
    }

    protected function addDirectivesForGoogleTagManager(): self
    {
        return $this->addDirective(Directive::SCRIPT, '*.googletagmanager.com');
    }

    protected function addDirectivesForTwitter(): self
    {
        return $this
            ->addDirective(Directive::SCRIPT, [
                'platform.twitter.com',
                '*.twimg.com',
            ])
            ->addDirective(Directive::STYLE, [
                'platform.twitter.com',
            ])
            ->addDirective(Directive::FRAME, [
                'platform.twitter.com',
                'syndication.twitter.com',
            ])
            ->addDirective(Directive::FORM_ACTION, [
                'platform.twitter.com',
                'syndication.twitter.com',
            ]);
    }

    protected function addDirectivesForYouTube(): self
    {
        return $this->addDirective(Directive::FRAME, '*.youtube.com');
    }

    protected function addDirectivesForStripe(): self
    {
        return $this
            ->addDirective(Directive::SCRIPT, ['stripe.com']);
    }

    protected function addDirectivesForCdnjs(): self
    {
        return $this
            ->addDirective(Directive::SCRIPT, ['https://cdnjs.cloudflare.com']);
    }

    protected function addDirectivesForSRI(): self
    {
        return $this
            ->addDirective(Directive::BASE, ';require-sri-for script style');
    }
}
