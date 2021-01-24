<?php

declare(strict_types=1);

namespace App\Models;

use Hyperf\Database\Model\Builder;
use Hyperf\DbConnection\Model\Model;
use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;

/**
 * Class BaseModel
 * @package App\Models
 * Date: 7/12/19
 * Time: 15:47
 * Author: david.li
 *
 */
abstract class BaseModel extends Model implements CacheableInterface
{
    use Cacheable;

    protected function boot(): void
    {
        parent::boot();
    }

}
