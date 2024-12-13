<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HashtagAnalyzeTest extends DuskTestCase
{
    /**
     * A Dusk test to verify the hashtag analyze form and result display.
     */
    public function testHashtagAnalyzeForm()
    {
        $inputHashtag = 'makansiang'; // Hashtag to test

        $this->browse(function (Browser $browser) use ($inputHashtag) {
            $browser->visit('http://127.0.0.1:8000')
                ->assertAttribute('@hashtag-input', 'placeholder', 'Enter hashtag')
                ->waitFor('@hashtag-input')
                ->type('@hashtag-input', $inputHashtag)
                ->press('@hashtag-analyze-button')
                ->waitForText($inputHashtag)
                ->assertSee($inputHashtag)
                ->waitFor('#username')
                ->assertSee($browser->text('#username'))
                ->waitFor('#caption')
                ->assertSee($browser->text('#caption'))
                ->waitFor('#like_count')
                ->assertSee($browser->text('#like_count'))
                ->waitFor('#comment_count')
                ->assertSee($browser->text('#comment_count'));
        });
    }
}