<p align="center">
  <img width="auto" height="200" src="/favicon.png"><br><br>
  Secure and anonymous file sharing without a database<br><br>
  <img src="https://img.shields.io/github/v/release/supernova3339/anonupload?style=for-the-badge" alt="latest version">
<img src="https://img.shields.io/github/stars/supernova3339/anonupload?style=for-the-badge" alt="repo stars">
<img src="https://img.shields.io/github/license/supernova3339/anonfiles?style=for-the-badge" alt="github">
<img src="https://img.shields.io/github/sponsors/supernova3339?style=for-the-badge" alt="github sponsors">
<img src="https://img.shields.io/github/issues-pr-raw/supernova3339/anonupload?style=for-the-badge" alt="github pull requests">
<a><img src="https://img.shields.io/gitter/room/supernova3339/anonupload?style=for-the-badge" alt="chat on gitter"></a>
  
</p>

--- 
<!-- images should be 116.6666667 by 26.6666667 for BRAND logos -->

![image](https://user-images.githubusercontent.com/63515814/209268440-faa934b4-d34c-4cf7-897c-d3f7fc74c005.png)

#### About

AnonUpload is a simple, databaseless PHP file uploader. It's built with privacy in mind, by not showing the direct filename used. 
    AnonUpload is designed to work anywhere! Nginx, Apache, Lightspeed, Anything Will Work! We don't use rewrites, just pure PHP. Heck, you could convert it to a laravel app if you wanted to! <!--(but please tell us if you do as honestly I personally would make an account system for it if you did)-->

#### Installation
Host with [![Easypanel](https://raw.githubusercontent.com/Supernova3339/Supernova3339/main/easypanel.png)](https://easypanel.io/docs/templates/anonupload)
<!-- want your logo here? send a PR! (please make sure to follow the BRAND logo size, or we will not be able to accept you) -->
```
docker run --name anonupload -p 80:80 -v /etc/anonupload/files:/var/www/html/files -e ADMIN_EMAIL=admin@admin.com -e ADMIN_PASSWORD=password -e APP_FILELIST=jpeg,jpg,gif,png,zip,xls,doc,mp3,mp4,mpeg,wav,avi,rar,7z,txt -e APP_SIZE_VERIFICATION=true -e APP_FILE_DESTINATION=files -e APP_BASE_URL=https://xxx.xxx/ -e APP_MAX_SIZE=10000000000 -e APP_MIN_SIZE=0 -e APP_CONTACT_EMAIL=changeme@dontforget.okay -e APP_DOWNLOAD_TIME=30 ghcr.io/supernova3339/anonfiles:1
```

#### Features

- Anonymous
- Databaseless
- Plausible Analytics Integration
- Dockerized

#### Documentation
[Environment Variables](env.md) - [Volumes](mounts.md)
