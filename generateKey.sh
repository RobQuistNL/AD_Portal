#!/bin/bash

if [[ $# == 2 ]]
then
	mkdir -p $2
	sudo $0 $1 $2 `whoami`
else
	if [ ! -f /etc/openvpn/easy-rsa/keys/$1.crt ] ;
	then
		cd /etc/openvpn/easy-rsa
		source /etc/openvpn/easy-rsa/vars
		KEY_CN=$1
		/etc/openvpn/easy-rsa/pkitool $1
	fi

	rm $2/*
	cp /etc/openvpn/easy-rsa/keys/$1.crt $2/user-$1.crt
	cp /etc/openvpn/easy-rsa/keys/$1.csr $2/user-$1.csr
	cp /etc/openvpn/easy-rsa/keys/$1.key $2/user-$1.key
	cp /etc/openvpn/easy-rsa/keys/ca.crt $2/ca.crt
	chown $3:$3 $2/*

	exit 0;
fi
