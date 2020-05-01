## AUTO FORMATING PHP SCRIPTS BEFORE COMMIT
This pre-commit hook, formating php-cs-fixers all php files before commit to git.
Formating rules is in setting file [.php_cs](https://github.com/otazniksk/git-hooks/blob/master/.php_cs)

## Useful Git Hooks scripts

- [pre-commit](https://github.com/otazniksk/git-hooks/tree/master/pre-commit) - This hook is called before obtaining the proposed commit message.

## Instalation this Git Hooks scripts
*Download and install files from github*


##### 1. Download git-hooks
```bash
git clone git@github.com:otazniksk/git-hooks.git
```
##### 1. Run composer install
```bash
cd git-hooks
composer install
```

# Create symlink
###Create symlink for OS Windows


Suppose the whole path to the file for our git-hooks is this:
```text
C:\wamp64\www\_helpers\git-hooks
```

Suppose the whole path to **your_project** and git hooks is this:
```text
C:\wamp64\www\your_project\.git\hooks
```
You must delete the entire hooks directory before creating a symlink
```text
rmdir /s "C:\wamp64\www\your_project\.git\hooks"
```
#### Creating a symlink so that our git-hooks use our .git in the project
**ATTENTATION!!** only for OS Windows
```bash
MKLINK /D C:\wamp64\www\your_project\.git\hooks C:\wamp64\www\_helpers\git-hooks
```

To apply in PhpStorm, you need to restart PhpStorm

