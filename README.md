# Coupon System #

## Project Description ##
This is a WordPress plugin created to provide a discount coupon distribution functionality. It works in connection with the WhatsApp chat bots created using Respond.IO.

## Functionality Workflow ##
1. The person interacts with the Chat-bot, entering their name on one of the steps.
2. The request is sent to the Rest Api endpoint created via the plugin. The data sent is phone number (from WhatsApp account) and user added name (from WhatsApp account).
3. The plugin checks the posts in the custom post type "clients" for the received phone number. If the user with this phone number exists, the link to the coupons page is returned to the whatsapp chat. The link includes query parameter of this user ID.
4. If user doesn't exist, the new post of this custom type is created with the user data. Afterwards, the link to the coupons page is returned to the whatsapp chat. The link includes query parameter of this user ID.
5. User can now select a coupon which is also sent back to the WhatsApp chat as PNG file with the customly generated QR-code.
6. The code can be redeemed in the participating locations.
