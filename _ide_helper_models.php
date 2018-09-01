<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Myweb\Entity{
/**
 * App\Myweb\Entity\NewImage
 *
 */
	class NewImage extends \Eloquent {}
}

namespace App\Myweb\Entity{
/**
 * App\Myweb\Entity\NewObject
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Myweb\Entity\NewImage[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Myweb\Entity\NewValue[] $values
 */
	class NewObject extends \Eloquent {}
}

namespace App\Myweb\Entity{
/**
 * App\Myweb\Entity\NewValue
 *
 */
	class NewValue extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */
	class User extends \Eloquent {}
}

