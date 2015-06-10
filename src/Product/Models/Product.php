<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;

class Product extends Model implements ProductInterface, VariableInterface
{
    use SoftDeletes, Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    protected $dates = ['deleted_at', 'available_on'];

    public $translatedAttributes = ['slug', 'name', 'description', 'meta_keywords', 'meta_description'];

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->available_on = new \DateTime();

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    public function isAvailable()
    {
        return new \DateTime() >= $this->available_on;
    }

    /**
     * {@inheritdoc}
     */
    public function variants()
    {
        return $this->hasMany('ANavallaSuiza\Ecommerce\Product\Models\Variant');
    }

    /**
     * {@inheritdoc}
     */
    public function getMasterVariant()
    {
        foreach ($this->variants as $variant) {
            if ($variant->isMaster()) {
                return $variant;
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function setMasterVariant(VariantInterface $variant)
    {
        $variant->setMaster(true);

        if (! $this->variants->contains($variant)) {
            $variant->setProduct($this);
            $this->variants->push($variant);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasVariants()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getVariants()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setVariants(Collection $variants)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function addVariant(VariantInterface $variant)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function removeVariant(VariantInterface $variant)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function hasVariant(VariantInterface $variant)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function hasOptions()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setOptions(Collection $options)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function addOption(OptionInterface $option)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionInterface $option)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function hasOption(OptionInterface $option)
    {

    }
}