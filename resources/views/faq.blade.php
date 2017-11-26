<?php
/**
 * @var array $badges
 */
?>
@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Frequently Asked Questions</h2>
            <hr />
            <strong>Q: Feature Request? Bug Report?</strong>
            <p>
                A: You can try submitting a question/comment over <a href="https://github.com/TrackerNetwork/DestinyStatus" target="_blank"><i class="fa fa-github-square"></i> GitHub</a>
                or <a href="https://twitter.com/DestinyStatus" target="_blank"><i class="fa fa-twitter-square"></i> Twitter</a>.
            </p>
            <br />
            <strong>Q: How do I get the <?= $badges['veteran']; ?> badge?</strong>
            <p>
                A: Until it is automated. Please view your Destiny 1 profile at <a target="_blank" href="https://d1.destinystatus.com">d1.destinystatus.com</a> and wait for the nightly check.
            </p>
            <br />
            <strong>Q: How do I get the <?= $badges['donator']; ?> badge?</strong>
            <p>
                A: Please donate via <a href="https://paypal.me/TrackerNetwork">paypal</a> and please include the words DestinyStatus & platform name and gamertag.
            </p>
            <br />
            <strong>Q: How do I fix this privacy error?</strong>
            <p>
                A: Either sign in or disable <a href="https://www.bungie.net/en/Profile/Settings?category=Privacy" target="_blank">privacy settings</a> on your account. If you are viewing someone else, that is their wish and cannot be changed.
            </p>
            <br />
            <strong>Q: Why are PC names unclickable on clan leaderboards?</strong>
            <p>
                A: Blizzard believes that uniquely identifying names is bad. So we only receive the part of name before pound sign. Bungie resolves this by including a unique membershipId,
                but if your system doesn't log/store that data you cannot connect the two.
            </p>
            <br />
            <strong>Q: Why is hard mode raid missing?</strong>
            <p>
                A: We developed based on the "milestone" feature, which was a complete mistake. There are milestones for talking to people, completing activities, etc. Hard Mode is not one of those
                things, in a future version this will no longer be a problem.
            </p>
            <br />
            @if (\Auth::check())
                <br />
                <strong>Q: How do I change my signed in account to a different platform (psn/xbl/pc)?</strong>
                <p>
                    A: Head <a href="<?= route('switch'); ?>">here</a> to select a different platform.
                </p>
            @endif
        </div>
    </div>
@stop