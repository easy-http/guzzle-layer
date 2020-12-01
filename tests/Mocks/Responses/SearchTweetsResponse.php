<?php

namespace Tests\Mocks\Responses;

class SearchTweetsResponse
{
    public static function tweets(): array
    {
        return [
            [
                'created_at' => 'Sun Feb 02 12:32:53 +0000 2020',
                'id' => 1223947395387547648,
                'id_str' => '1223947395387547648',
                'text' => '@Femi_Sorry I’m against brexit. When a doctor gives you a diagnosis - it is opinion. It can be backed up with facts… https://t.co/U70geQwkPw', // phpcs:ignore
                'truncated' => true,
                'entities' => [
                    'hashtags' => [],
                    'symbols' => [],
                    'user_mentions' => [
                        [
                            'screen_name' => 'Femi_Sorry',
                            'name' => 'Femi',
                            'id' => 234694571,
                            'id_str' => '234694571',
                            'indices' => [
                                0 => 0,
                                1 => 11,
                            ],
                        ],
                    ],
                    'urls' => [
                        [
                            'url' => 'https://t.co/U70geQwkPw',
                            'expanded_url' => 'https://twitter.com/i/web/status/1223947395387547648',
                            'display_url' => 'twitter.com/i/web/status/1…',
                            'indices' => [
                                0 => 117,
                                1 => 140,
                            ],
                        ],
                    ],
                ],
                'source' => '<a href="http://twitter.com/download/iphone" rel="nofollow">Twitter for iPhone</a>',
                'in_reply_to_status_id' => 1223898656237146113,
                'in_reply_to_status_id_str' => '1223898656237146113',
                'in_reply_to_user_id' => 234694571,
                'in_reply_to_user_id_str' => '234694571',
                'in_reply_to_screen_name' => 'Femi_Sorry',
                'user' => [
                    'id' => 70512422,
                    'id_str' => '70512422',
                    'name' => 'James Mallison',
                    'screen_name' => 'J7mbo',
                    'location' => 'Bavaria, Germany',
                    'description' => '🇬🇧Conference Speaker. Go, PHP, Swift. Owns Dockercon socks. Swears in 🇪🇸🇩🇪. Opinions are yours. Senior Manager Engineering @SixtDE. Ex: Tech Lead @trivago', // phpcs:ignore
                    'url' => 'https://t.co/tzMtUFaORN',
                    'entities' => [
                        'url' => [
                            'urls' => [
                                [
                                    'url' => 'https://t.co/tzMtUFaORN',
                                    'expanded_url' => 'https://blog.j7mbo.com',
                                    'display_url' => 'blog.j7mbo.com',
                                    'indices' => [
                                        0 => 0,
                                        1 => 23,
                                    ],
                                ],
                            ],
                        ],
                        'description' => [
                            'urls' => [],
                        ],
                    ],
                    'protected' => false,
                    'followers_count' => 1510,
                    'friends_count' => 297,
                    'listed_count' => 127,
                    'created_at' => 'Mon Aug 31 21:57:28 +0000 2009',
                    'favourites_count' => 7882,
                    'utc_offset' => null,
                    'time_zone' => null,
                    'geo_enabled' => true,
                    'verified' => false,
                    'statuses_count' => 13195,
                    'lang' => null,
                    'contributors_enabled' => false,
                    'is_translator' => false,
                    'is_translation_enabled' => false,
                    'profile_background_color' => '000000',
                    'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme15/bg.png',
                    'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme15/bg.png',
                    'profile_background_tile' => false,
                    'profile_image_url' => 'http://pbs.twimg.com/profile_images/923304899940626432/g6n2llxZ_normal.jpg',
                    'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/923304899940626432/g6n2llxZ_normal.jpg', // phpcs:ignore
                    'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/70512422/1530129419',
                    'profile_link_color' => '000000',
                    'profile_sidebar_border_color' => '000000',
                    'profile_sidebar_fill_color' => '000000',
                    'profile_text_color' => '000000',
                    'profile_use_background_image' => false,
                    'has_extended_profile' => true,
                    'default_profile' => false,
                    'default_profile_image' => false,
                    'can_media_tag' => false,
                    'followed_by' => false,
                    'following' => true,
                    'follow_request_sent' => false,
                    'notifications' => false,
                    'translator_type' => 'regular',
                ],
                'geo' => null,
                'coordinates' => null,
                'place' => null,
                'contributors' => null,
                'is_quote_status' => false,
                'retweet_count' => 0,
                'favorite_count' => 0,
                'favorited' => false,
                'retweeted' => false,
                'lang' => 'en',
            ],
            [
                'created_at' => 'Sun Feb 02 12:06:02 +0000 2020',
                'id' => 1223940638183432192,
                'id_str' => '1223940638183432192',
                'text' => '@sylv3on_ I found this too. What I did was leverage that flaunting of knowledge etc and took it in for myself. I fo… https://t.co/lQdSEz5lTR', // phpcs:ignore
                'truncated' => true,
                'entities' => [
                    'hashtags' => [],
                    'symbols' => [],
                    'user_mentions' => [
                        [
                            'screen_name' => 'sylv3on_',
                            'name' => 'Ａｓｈ💕',
                            'id' => 1105153975320526850,
                            'id_str' => '1105153975320526850',
                            'indices' => [
                                0 => 0,
                                1 => 9,
                            ],
                        ],
                    ],
                    'urls' => [
                        [
                            'url' => 'https://t.co/lQdSEz5lTR',
                            'expanded_url' => 'https://twitter.com/i/web/status/1223940638183432192',
                            'display_url' => 'twitter.com/i/web/status/1…',
                            'indices' => [
                                0 => 117,
                                1 => 140,
                            ],
                        ],
                    ],
                ],
                'source' => '<a href="http://twitter.com/download/iphone" rel="nofollow">Twitter for iPhone</a>',
                'in_reply_to_status_id' => 1223764921432887297,
                'in_reply_to_status_id_str' => '1223764921432887297',
                'in_reply_to_user_id' => 1105153975320526850,
                'in_reply_to_user_id_str' => '1105153975320526850',
                'in_reply_to_screen_name' => 'sylv3on_',
                'user' => [
                    'id' => 70512422,
                    'id_str' => '70512422',
                    'name' => 'James Mallison',
                    'screen_name' => 'J7mbo',
                    'location' => 'Bavaria, Germany',
                    'description' => '🇬🇧Conference Speaker. Go, PHP, Swift. Owns Dockercon socks. Swears in 🇪🇸🇩🇪. Opinions are yours. Senior Manager Engineering @SixtDE. Ex: Tech Lead @trivago', // phpcs:ignore
                    'url' => 'https://t.co/tzMtUFaORN',
                    'entities' => [
                        'url' => [
                            'urls' => [
                                [
                                    'url' => 'https://t.co/tzMtUFaORN',
                                    'expanded_url' => 'https://blog.j7mbo.com',
                                    'display_url' => 'blog.j7mbo.com',
                                    'indices' => [
                                        0 => 0,
                                        1 => 23,
                                    ],
                                ],
                            ],
                        ],
                        'description' => [
                            'urls' => [],
                        ],
                    ],
                    'protected' => false,
                    'followers_count' => 1510,
                    'friends_count' => 297,
                    'listed_count' => 127,
                    'created_at' => 'Mon Aug 31 21:57:28 +0000 2009',
                    'favourites_count' => 7882,
                    'utc_offset' => null,
                    'time_zone' => null,
                    'geo_enabled' => true,
                    'verified' => false,
                    'statuses_count' => 13195,
                    'lang' => null,
                    'contributors_enabled' => false,
                    'is_translator' => false,
                    'is_translation_enabled' => false,
                    'profile_background_color' => '000000',
                    'profile_background_image_url' => 'http://abs.twimg.com/images/themes/theme15/bg.png',
                    'profile_background_image_url_https' => 'https://abs.twimg.com/images/themes/theme15/bg.png',
                    'profile_background_tile' => false,
                    'profile_image_url' => 'http://pbs.twimg.com/profile_images/923304899940626432/g6n2llxZ_normal.jpg',
                    'profile_image_url_https' => 'https://pbs.twimg.com/profile_images/923304899940626432/g6n2llxZ_normal.jpg', // phpcs:ignore
                    'profile_banner_url' => 'https://pbs.twimg.com/profile_banners/70512422/1530129419',
                    'profile_link_color' => '000000',
                    'profile_sidebar_border_color' => '000000',
                    'profile_sidebar_fill_color' => '000000',
                    'profile_text_color' => '000000',
                    'profile_use_background_image' => false,
                    'has_extended_profile' => true,
                    'default_profile' => false,
                    'default_profile_image' => false,
                    'can_media_tag' => false,
                    'followed_by' => false,
                    'following' => true,
                    'follow_request_sent' => false,
                    'notifications' => false,
                    'translator_type' => 'regular',
                ],
                'geo' => null,
                'coordinates' => null,
                'place' => null,
                'contributors' => null,
                'is_quote_status' => false,
                'retweet_count' => 0,
                'favorite_count' => 0,
                'favorited' => false,
                'retweeted' => false,
                'lang' => 'en',
            ],
        ];
    }
}
