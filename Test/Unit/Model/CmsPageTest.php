<?php

namespace Fiko\Training\Test\Unit\Model;

use Fiko\Training\Model\CmsPage;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Cms\Model\Page;
use Magento\Cms\Model\PageSearchResults;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;

class CmsPageTest extends TestCase
{
    protected $objectManager;
    protected $model;
    protected $pageRepositoryInterface;
    protected $searchCriteriaBuilder;
    protected $searchCriteria;

    /**
     * This method will be called on every test method
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->objectManager = new ObjectManager($this);
        $this->pageRepositoryInterface = $this->createMock(pageRepositoryInterface::class);
        $this->searchCriteriaBuilder = $this->createMock(SearchCriteriaBuilder::class);

        $this->searchCriteria = $this->objectManager->getObject(SearchCriteria::class, ['data' => []]);

        $this->model = $this->objectManager->getObject(
            CmsPage::class,
            [
                'pageRepositoryInterface' => $this->pageRepositoryInterface,
                'searchCriteriaBuilder' => $this->searchCriteriaBuilder,
                'data' => [],
            ]
        );
    }

    /**
     * Testing getCmsPageDetails
     *
     * @return void
     * @dataProvider getCmsPageDetailsProvider
     */
    public function testGetCmsPageDetails($expected, $content)
    {
        $addFilter = $this->createMock(SearchCriteriaBuilder::class);
        $addFilter->expects($this->once())->method('create')->willReturn($this->searchCriteria);
        $this->searchCriteriaBuilder->expects($this->once())->method('addFilter')
            ->willReturn($addFilter);

        $getContent = $this->createMock(Page::class);
        $getContent->expects($this->once())->method('getContent')->willReturn($content);
        $getItems = $this->createMock(PageSearchResults::class);
        $getItems->expects($this->once())->method('getitems')->willReturn([$getContent]);
        $this->pageRepositoryInterface->expects($this->once())->method('getList')->with($this->searchCriteria)
            ->willReturn($getItems);

        $result = $this->model->getCmsPageDetails();
        $this->assertEquals($expected, $result);
    }

    /**
     * Data for testGetCmsPageDetails testing method
     *
     * @return array
     * @see self::testGetCmsPageDetails()
     */
    public function getCmsPageDetailsProvider()
    {
        return [
            ["Lorem ipsum dolor sit amet", "Lorem ipsum dolor sit amet"],
        ];
    }
}
