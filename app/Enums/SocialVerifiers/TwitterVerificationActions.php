<?php

namespace App\Enums\SocialVerifiers;

enum TwitterVerificationActions
{
    case retweet;
    case like;
    case follow;
    case reply;
}
