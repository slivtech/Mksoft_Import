# Mksoft Import

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Mksoft`
 - Enable the module by running `php bin/magento module:enable Mksoft_Import`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

## Configuration

 - Cronjob **mksoft_import_update_product_attributes** run every 15 minutes.
 - Manual command for update product attributes:
    - `php bin/mksoft_import:update_attr`



