##### Administration
---
| ENV | Description | Required | Example |
| ------ | ------ | ------ | ------ |
| ADMIN_EMAIL | Sets the login email for the administration panel | YES  | admin@admin.com
| ADMIN_PASSWORD | Sets the login password for the administration panel | YES  | password

##### SEO
---
| ENV | Description | Required | Example |
| ------ | ------ | ------| ------ |
| APP_NAME | Sets the app title | YES  | AnonUpload - Secure File Sharing
| APP_DESC | Sets the app description  | YES | Secure and anonymous file sharing
| APP_CONTACT_EMAIL | Sets the report files email | YES | admin@admin.com

##### Plausible
---
| ENV | Description | Required | Example |
| ------ | ------ | ------ | ------ |
| PLAUSIBLE_DOMAIN | Your plausible installations domain | NO | https://xxx.xxx
| PLAUSIBLE_DATA_DOMAIN | Your plausible data domain | NO | xxx.xxx
| PLAUSIBLE_EMBED_TOKEN | Your plausible embed codes **AUTH** token | NO | -xxxxxx-xxxxxx

##### Uploader
---
| ENV | Description | Required | Example
| ------ | ------ | ------ | ------ |
| APP_FILELIST | List of supported files | YES | jpeg,jpg,gif,png,zip,xls,doc,mp3,mp4,mpeg,wav,avi,rar,7z,txt
| APP_SIZE_VERIFICATION | Verify uploaded file size | YES | true/false
| APP_FILE_DESTINATION | File destination folder | YES | files
| APP_BASE_URL | Application base URL | YES | https://xxx.xxx/
| APP_MAX_SIZE | Application max upload size in BYTES | YES | 10000000000 [10GB]
| APP_MIN_SIZE | Application minimum upload size in BYTES | YES | 0 [0KB]
| APP_DOWNLOAD_TIME | Time to wait until file downloads | YES | 30 (in seconds)
