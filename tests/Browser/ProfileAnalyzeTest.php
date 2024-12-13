<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProfileAnalyzeTest extends DuskTestCase
{
    /**
     * A Dusk test to verify the profile analyze form and result display.
     */
    public function testProfileAnalyzeForm()
    {
        $inputUsername = 'himsiunair'; // Username to test

        $this->browse(function (Browser $browser) use ($inputUsername) {
            $browser->visit('http://127.0.0.1:8000')
                ->assertAttribute('@username-input', 'placeholder', 'Enter Instagram username')
                ->waitFor('@username-input')
                ->type('@username-input', $inputUsername)
                ->press('@profile-analyze-button')
                ->waitForText($inputUsername)
                ->assertSee($inputUsername)
                ->waitFor('#full-name')
                ->assertSee($browser->text('#full-name'))
                ->waitFor('#bio')
                ->assertSee($browser->text('#bio'))
                ->waitFor('#category')
                ->assertSee($browser->text('#category'))
                ->waitFor('#follower_count')
                ->assertSee($browser->text('#follower_count'))
                ->waitFor('#posts_count')
                ->assertSee($browser->text('#posts_count'))
                ->waitFor('#bio_links')
                ->assertSee($browser->text('#bio_links'))
                ->waitFor('#top_hashtags')
                ->assertSee($browser->text('#top_hashtags'))
                ->waitFor('#avg_likes')
                ->assertSee($browser->text('#avg_likes'))
                ->waitFor('#avg_comments')
                ->assertSee($browser->text('#avg_comments'))
                ->waitFor('#engagement_rate')
                ->assertSee($browser->text('#engagement_rate'))
                ->waitFor('#avg_activity')
                ->assertSee($browser->text('#avg_activity'))
                ->waitFor('#percentage_change')
                ->assertSee($browser->text('#percentage_change'))
                ->waitFor('#account_score')
                ->assertSee($browser->text('#account_score'))
                ->waitFor('#publishing_frequency')
                ->assertSee($browser->text('#publishing_frequency'))
                ->waitFor('#positive_percentage')
                ->assertSee($browser->text('#positive_percentage'))
                ->waitFor('#negative_percentage')
                ->assertSee($browser->text('#negative_percentage'))
                ->waitFor('#neutral_percentage')
                ->assertSee($browser->text('#neutral_percentage'))
                ->waitFor('#most_active_day')
                ->assertSee($browser->text('#most_active_day'));
        });
    }
}