# -*- mode: ruby -*-
# vi: set ft=ruby :

module OS
    def OS.windows?
        (/cygwin|mswin|mingw|bccwin|wince|emx/ =~ RUBY_PLATFORM) != nil
    end

    def OS.mac?
        (/darwin/ =~ RUBY_PLATFORM) != nil
    end

    def OS.unix?
        !OS.windows?
    end

    def OS.linux?
        OS.unix? and not OS.mac?
    end
end

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "debian/buster64"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  # config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  # config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
  config.vm.network "forwarded_port", guest: 8025, host: 8025, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  config.vm.network "private_network", ip: "192.168.44.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  config.vm.synced_folder '.', '/vagrant', disabled: true
   if OS.windows?
    config.vm.synced_folder "./", "/home/vagrant/crm.hireamover.com.au", type: 'nfs', create: true
    config.vm.synced_folder "../www.hireamover.com.au/", "/home/vagrant/www.hireamover.com.au", type: 'nfs', create: true
   else
    config.vm.synced_folder "./", "/home/vagrant/crm.hireamover.com.au", type: "virtualbox", create: true, mount_options: ["dmode=777", "fmode=777"]
    config.vm.synced_folder "../www.hireamover.com.au/", "/home/vagrant/www.hireamover.com.au", type: "virtualbox", create: true, mount_options: ["dmode=777", "fmode=777"]
   end

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  config.vm.provider "virtualbox" do |vb|
  #   vb.gui = true
     vb.memory = "2048"
     vb.cpus = "2"
  end

  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Enable provisioning with a shell script. Additional provisioners such as
  # Puppet, Chef, Ansible, Salt, and Docker are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", inline: <<-SHELL
    sudo apt update -y;
    sudo apt install -y wget nano;


    # SSHD
    echo "PasswordAuthentication yes" >> /etc/ssh/sshd_config
    echo "PermitRootLogin yes" >> /etc/ssh/sshd_config
    systemctl restart sshd;

    # Install Multiple PHP
    sudo apt-get install -y curl wget gnupg2 ca-certificates lsb-release apt-transport-https;
    wget https://packages.sury.org/php/apt.gpg;
    sudo apt-key add apt.gpg
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php7.list
    sudo apt-get update -y;
    apt install -y php5.6 php5.6-bz2 php5.6-cli php5.6-common php5.6-curl php5.6-exif php5.6-fileinfo php5.6-fpm php5.6-gd php5.6-gettext php5.6-iconv php5.6-mbstring php5.6-opcache php5.6-pdo php5.6-soap php5.6-sockets php5.6-tidy php5.6-xml php5.6-xmlrpc php5.6-zip php5.6-mysqli;
    apt install -y php7.2 php7.2-bz2 php7.2-cli php7.2-common php7.2-curl php7.2-exif php7.2-fileinfo php7.2-fpm php7.2-gd php7.2-gettext php7.2-iconv php7.2-mbstring php7.2-opcache php7.2-pdo php7.2-soap php7.2-sockets php7.2-tidy php7.2-xml php7.2-xmlrpc php7.2-zip php7.2-mysqli;

    # Install nginx
    apt install -y nginx;
    cp -a /home/vagrant/crm.hireamover.com.au/deployment/nginx/* /etc/nginx/sites-enabled/
    systemctl restart nginx;

    # Mariadb / database
    apt install -y mariadb-server mariadb-client;
    cd /home/vagrant/crm.hireamover.com.au/deployment;
    gunzip -k prod_hireamover_crm.sql.gz;
    echo "CREATE DATABASE crm;" | mysql
    mysql -D crm < prod_hireamover_crm.sql;
    rm prod_hireamover_crm.sql;
    echo "ALTER USER 'root'@'localhost' IDENTIFIED BY 'secret';" | mysql
    echo "UPDATE email_config SET smtp_port=1025,smtp_pass='',smtp_host='localhost'" | mysql -D crm -u root --password=secret

    # Install mailhog
    wget -O /usr/local/bin/mailhog http://mirror.mediacp.net/download/common/MailHog_linux_amd64
    chmod +x /usr/local/bin/mailhog

    cp -a /home/vagrant/crm.hireamover.com.au/deployment/mailhog.service /etc/systemd/system/mailhog.service;
    systemctl enable mailhog;
    systemctl start mailhog;

    # Install Composer
    apt install -y composer;

    # Link public/assets
    cd /home/vagrant/crm.hireamover.com.au/;
    ln -s ../assets public/assets;

  SHELL
end
