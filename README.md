# Vulnview #

## Purpose of vulnview ##
To collate RSS fedds from multiple sites / vendors, making it easier to identify patch and vulnerability alerts without trawling through multiple sites.

Written using `PHP`, I've tried to keep it lightweight, so it doesn't require any sort of DB, and the powershell script using '`invoke-webrequest`' to retrieve the feeds from the websites.

### Adding new feeds ###
Use **'clipboard icon'** in the title, or you can uncomment the **'Feed Admin'** button, and just add the new feed in this format **[title],[feed url]** (e.g. Krebs,https://krebsonsecurity.com/feed/) the PHP will explode the list item and process the feed accordingly.

## Output ##
This is the sort of output you can expect.

![Image](https://github.com/richeaston/VulnView/blob/master/vulnview.jpg?raw=true "Example Output")


