{extends file="parent:frontend/detail/data.tpl"}


{* Regular price *}
{block name='frontend_detail_data_price_default'}
<div class="pricebox">
    <span class="price--content content--default">
                                <meta itemprop="price" content="{$sArticle.price|replace:',':'.'}">
        {if $sArticle.priceStartingFrom}{s name='ListingBoxArticleStartsAt' namespace="frontend/listing/box_article"}{/s} {/if}{$sArticle.price|currency} {s name="Star" namespace="frontend/listing/box_article"}{/s}
    </span>
</div>
{/block}


{block name='frontend_detail_data_price_configurator'}
	{$smarty.block.parent}
	{if $Locale == "ko_KR"}
       <div class="priceinfobox wonprice">
            {$todayCurrency['templatechar']} {{{{{$todayCurrency['factor']*{$sArticle.price|replace:',':'.'}}/100}|string_format:"%d"}*100}|number_format:0:".":","}
       </div>

         <div class="priceinfobox rateinfo">
             {$date}{s name="Standard_Currency"} {/s}
             {$todayCurrency['factor']}
             {s name="Currency_Apply"} {/s}
           <br> | {$startDate|date_format:"%Y/%m/%d"}
        </div>
    {/if}
{/block}
