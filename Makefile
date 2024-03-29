restart: stop start
start:
	@echo "\033[45m\033[1;37m Start \033[0m"
	@docker compose up
	@echo "\n[\033[32m Ok \033[00m]"

build:
	@echo "\033[45m\033[1;37m Build \033[0m"
	@docker compose up --build
	@echo "\n[\033[32m Ok \033[00m]"

remove:
	@echo "\033[45m\033[1;37m Remove \033[0m"
	@docker compose rm -fv $(docker ps -aq)
	@echo "\n[\033[32m Ok \033[00m]"

stop:
	@echo "\033[45m\033[1;37m Stopping \033[0m"
	@docker compose down
	@echo "\n[\033[32m Ok \033[00m]"

state:
	@$(compose) ps