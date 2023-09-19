<?php
/**
* Created By : Pvt. Ltd.
 */
namespace Fiko\Training\Model;

use Magento\Framework\Api\SearchCriteriaInterface;

class CmsPage
{
    const url= "home";

    /**
     * @var \Magento\Cms\Api\PageRepositoryInterface
     */
    protected $pageRepositoryInterface;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Cms\Api\PageRepositoryInterface         $pageRepositoryInterface
     * @param \Magento\Framework\Api\SfearchCriteriaBuilder     $searchCriteriaBuilder
     * @param array                                            $data
     */
    public function __construct(
        \Magento\Cms\Api\PageRepositoryInterface $pageRepositoryInterface,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->pageRepositoryInterface = $pageRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

    }

    /**
     * Return CMS Page Details by URL Key
     *
     * @param  string $urlKey
     * @return string
     */
    public function getCmsPageDetails()
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('identifier', static::url, 'eq')->create();
        $pages = current($this->pageRepositoryInterface->getList($searchCriteria)->getItems())->getContent();
        return $pages;
    }
}
