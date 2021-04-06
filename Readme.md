# Description
This project is a proof of concept on how to generate a customized iOS profile.
With the profile, you may easily configure your email account on an iOS device such as an iPhone or iPad.

# Setting Up
## Editing the Configuration File
Open the `.mobileconfig` file in any text editor. Please note that it's basically an XML file. Modify it accordingly, if you must.
Leave the field values `DISPLAYNAME` and `MAILADDR` as is, except if `IncomingMailServerUsername` and `OutgoingMailServerUsername` are supposed to differ from the email address. If so, you may have to modify both the PHP code and the XML-formatted file.

It may be necessary to modify the hostnames, ports and whether the connection shall be made over SSL/TLS. While modifying, you may search for the term "example" (case insensitive).

## Editing the PHP Code
Now open the PHP file in any text editor. Add an array of trusted domains in `TRUSTEDDOMAINS`.

Note that the PHP code assumes that the email addresses will be formatted as `jane.doe@example.com` for a person named "Jane Doe". So the `DISPLAYNAME` will be set accordingly.

# Usage
Once you have set up as described above, upload the files to your webserver and call the HTML page. That's it.

# Compatibility
This method should be compatible with any Apple devices with iOS 5, iPadOS 13.1 or later versions. The functionality was tested with iOS 14.

# More on Apple MDM
You may read further on Apple's Mobile Device Management (MDM) in the follwing articles:

* [Install a configuration profile on your iPhone or iPad - Apple Support](https://support.apple.com/en-us/HT209435)
* [MDM overview for Apple devices - Apple Support](https://support.apple.com/guide/mdm/mdm-overview-mdmbf9e668/web)
* [Configuring Multiple Devices Using Profiles - Apple Developer Documentation](https://developer.apple.com/documentation/devicemanagement/configuring_multiple_devices_using_profiles)
* [Device Management - Apple Developer Documentation](https://developer.apple.com/documentation/devicemanagement)

# Copyright
Copyright © 2021 - present Liberale Demokraten - Die Sozialliberalen. Free use of this project's contents is granted under the terms of the GNU GPLv3 license. For the full text of the license, see the [LICENSE](LICENSE.txt) file. The HTML file providing a sample form however is licensed under the [CC0 Public Domain](https://creativecommons.org/publicdomain/zero/1.0/) license such that you can use, modify and distribute it without any limitations of any sorts.

The use of the resources provided by this project shall be done in a way that your modifications to the code, distribution thereof or use of the provided files does not imply any endorsement by the authors or copyright holders of this project. You shall not use this project or contents thereof in the name of the authors or copyright holders unless explicitly permitted.