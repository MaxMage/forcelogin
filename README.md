# Force Login Magento® 2

Magento® 2 module force login customers

## Installation

1. Go to Magento® 2 root directory

2. Enter following commands to install module:

   ```
   composer require maxmage/forcelogin
   ```

   Wait while dependencies are updated.

3. Enter following commands to enable module:

   ```
   php bin/magento module:enable MaxMage_ForceLogin
   php bin/magento setup:upgrade
   php bin/magento cache:clean
   ```
5. Enable the Force Login module in Magento® Admin under *Stores* >
   *Configuration* > *Customers* > *Force Login*.
   
## Requirements

1) For Magento® 2.1.x and Magento® 2.2.x