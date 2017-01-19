# v2.3.0 (January 19, 2017)
 * Leaky Bucket algorithm to prevent going over rate limit - #19
 * Add "Stats" tab.

# v2.2.3 (January 15, 2017)
 * Fix characters that are returning ("No stats") - #55.

# v2.2.2 (January 12, 2017)
 * Revert (Sort characters by last played, not static.)
 * Add Abbadon & Nova Mortis to exotics tab.

# v2.2.1 (December 14, 2016)
 * Fix index cache not expiring properly.
 * Sort characters by last played, not static.
 * Don't show expired events.
 * Update bugged grimoire cards (Thanks 1436346).
 * Handle decoding of entities properly.

# v2.2.0 (November 6, 2016)
 * Added "Exotic Weapon" quest tab.
 * Mark classified items properly to prevent dead images.
 * Add "Bugged" grimoire cards.
 * Switch to a file store for some caches

# v2.1.0 (October 17, 2016)
 * Ability for profiles to be private and still work.
 * Ability for requests to fail (Checklist, stats, history, etc) and still work.
 * update PSN Exclusive grimoire.

# v2.0.0 (September 30, 2016)
 * Rewrite to Laravel 5.1
 * Move to `/summary` endpoints and new `v2` advisor.
 * New Module based homepage
   * Trials Module (w/ rewards at 5/7 wins)
   * IB Module
   * Xur Module (w/ weapons sold)
   * ArmsDay Module (w/ packages sold)
 * HTTPS everywhere
 * Bower removed in favor of elixir

# v1.0.0 (Unknown)
 * initial release