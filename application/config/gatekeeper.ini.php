[roles]
guest = 0
user = 10
admin = 100

[rules]
index.index.guest = allow
index.index.user = allow
index.index.admin = allow

user.index.guest = deny
user.index.user = deny
user.index.admin = allow

user.contact.guest = allow
user.contact.user = allow
user.contact.admin = allow

user.list.guest = deny
user.list.user = deny
user.list.admin = allow

user.login.guest = allow
user.login.user = deny
user.login.admin = deny

user.logout.guest = deny
user.logout.user = allow
user.logout.admin = allow

user.register.guest = allow
user.register.user = deny
user.register.admin = deny

user.processlogin.guest = allow
user.processlogin.user = deny
user.processlogin.admin = deny

user.processregister.guest = allow
user.processregister.user = deny
user.processregister.admin = deny

error.accessdenied.guest = allow
error.accessdenied.user = allow
error.accessdenied.admin = allow

error.pagenotfound.guest = allow
error.pagenotfound.user = allow
error.pagenotfound.admin = allow

[actions]
tracker.index.guest = redirect.user.login

user.index.guest = redirect.user.login
user.index.user = redirect.user.login

user.list.guest = redirect.user.login
user.list.user = redirect.index.index

user.login.user = redirect.user.edit
user.login.admin = redirect.user.edit

user.logout.guest = redirect.user.login

user.register.user = redirect.user.edit
user.register.admin = redirect.user.edit

user.processlogin.user = redirect.index.index
user.processlogin.admin = redirect.index.index

user.processregister.user = redirect.index.index
user.processregister.admin = redirect.index.index
