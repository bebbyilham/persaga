/// Authentication setup ///
qz.security.setCertificatePromise(function (resolve, reject) {
	$.ajax("<?= base_url() ?>assets/override.crt").then(resolve, reject);
	//Preferred method - from server
	//        fetch("assets/signing/digital-certificate.txt", {cache: 'no-store', headers: {'Content-Type': 'text/plain'}})
	//          .then(function(data) { data.ok ? resolve(data.text()) : reject(data.text()); });

	//Alternate method 1 - anonymous
	//        resolve();  // remove this line in live environment

	//Alternate method 2 - direct
	//     resolve("-----BEGIN CERTIFICATE-----\n" +
	//                 "MIIEFTCCAv2gAwIBAgIUXTxyZlubkH24/TmynDosOvfzEGQwDQYJKoZIhvcNAQEL\n" +
	//                 "BQAwgZgxCzAJBgNVBAYTAklEMRcwFQYDVQQIDA5TdW1hdGVyYSBCYXJhdDEPMA0G\n" +
	//                 "A1UEBwwGUGFkYW5nMRYwFAYDVQQKDA1SU0ogSEIgU0FBTklOMQswCQYDVQQLDAJJ\n" +
	//                 "b20xJzAlBgkqhkiG9w0BCQEWGHN1cHBvcnRAcXppbmR1c3RyaWVzLmNvbTAeFw0x\n" +
	//                 "VDESMBAGA1UEAwwJbG9jYWxob3N0MSYwJAYJKoZIhvcNAQkBFhdyc2poYnNhYW5p\n" +
	//                 "gZgxCzAJBgNVBAYTAklEMRcwFQYDVQQIDA5TdW1hdGVyYSBCYXJhdDEPMA0GA1UE\n" +
	//                 "BwwGUGFkYW5nMRYwFAYDVQQKDA1SU0ogSEIgU0FBTklOMQswCQYDVQQLDAJJVDES\n" +
	//                 "MBAGA1UEAwwJbG9jYWxob3N0MSYwJAYJKoZIhvcNAQkBFhdyc2poYnNhYW5pbml0\n" +
	//                 "QGdtYWlsLmNvbTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAPUgQuNH\n" +
	//                 "x80PHicsWvBhvWpfkJQeOq/z+Jpo4K+yIaJqLIjKuOHP6KBIV7Jz4ykcBvFE9tt0\n" +
	//                 "Q9PU15uwEs1SmcsPSgNn9R029SQcbGfhsqP3X0yhMKIrb48lO8J1CIut0xe3JASZ\n" +
	//                 "sJAphnUHsiqcfxgLGjgXVvbJi8f06B6Ai+VGLUMogSSCocyfatzWQUK7Q9K/k8tT\n" +
	//                 "sjgLYx8Mu1UktXMNuFYeKDF6itPQ7t+G1O5LaYxbt5s7vn16jPqqWRTkYyAkXr9p\n" +
	//                 "HMkhTyQyytiFICcDTtON73ytNlgli8bNr7/fLWSDsI++MqhSy8pHGmF5YHYsQAlm\n" +
	//                 "bmVyYXRlZCBDZXJ0aWZpY2F0ZTAdBgNVHQ4EFgQUpG420UhvfwAFMr+8vf3pJunQ\n" +
	//                 "gH4wHwYDVR0jBBgwFoAUkKZQt4TUuepf8gWEE3hF6Kl1VFwwDQYJKoZIhvcNAQEF\n" +
	//                 "BQADggIBAFXr6G1g7yYVHg6uGfh1nK2jhpKBAOA+OtZQLNHYlBgoAuRRNWdE9/v4\n" +
	//                 "J/3Jeid2DAyihm2j92qsQJXkyxBgdTLG+ncILlRElXvG7IrOh3tq/TttdzLcMjaR\n" +
	//                 "8w/AkVDLNL0z35shNXih2F9JlbNRGqbVhC7qZl+V1BITfx6mGc4ayke7C9Hm57X0\n" +
	//                 "ak/NerAC/QXNs/bF17b+zsUt2ja5NVS8dDSC4JAkM1dD64Y26leYbPybB+FgOxFu\n" +
	//                 "wou9gFxzwbdGLCGboi0lNLjEysHJBi90KjPUETbzMmoilHNJXw7egIo8yS5eq8RH\n" +
	//                 "i2lS0GsQjYFMvplNVMATDXUPm9MKpCbZ7IlJ5eekhWqvErddcHbzCuUBkDZ7wX/j\n" +
	//                 "unk/3DyXdTsSGuZk3/fLEsc4/YTujpAjVXiA1LCooQJ7SmNOpUa66TPz9O7Ufkng\n" +
	//                 "+CoTSACmnlHdP7U9WLr5TYnmL9eoHwtb0hwENe1oFC5zClJoSX/7DRexSJfB7YBf\n" +
	//                 "vn6JA2xy4C6PqximyCPisErNp85GUcZfo33Np1aywFv9H+a83rSUcV6kpE/jAZio\n" +
	//                 "5qLpgIOisArj1HTM6goDWzKhLiR/AeG3IJvgbpr9Gr7uZmfFyQzUjvkJ9cybZRd+\n" +
	//                 "G8azmpBBotmKsbtbAU/I/LVk8saeXznshOVVpDRYtVnjZeAneso7\n" +
	//                 "-----END CERTIFICATE-----\n" +
	//                 "--START INTERMEDIATE CERT--\n" +
	//                 "-----BEGIN CERTIFICATE-----\n" +
	//                 "MIIFEjCCA/qgAwIBAgICEAAwDQYJKoZIhvcNAQELBQAwgawxCzAJBgNVBAYTAlVT\n" +
	//                 "MQswCQYDVQQIDAJOWTESMBAGA1UEBwwJQ2FuYXN0b3RhMRswGQYDVQQKDBJRWiBJ\n" +
	//                 "bmR1c3RyaWVzLCBMTEMxGzAZBgNVBAsMElFaIEluZHVzdHJpZXMsIExMQzEZMBcG\n" +
	//                 "A1UEAwwQcXppbmR1c3RyaWVzLmNvbTEnMCUGCSqGSIb3DQEJARYYc3VwcG9ydEBx\n" +
	//                 "emluZHVzdHJpZXMuY29tMB4XDTE1MDMwMjAwNTAxOFoXDTM1MDMwMjAwNTAxOFow\n" +
	//                 "gZgxCzAJBgNVBAYTAlVTMQswCQYDVQQIDAJOWTEbMBkGA1UECgwSUVogSW5kdXN0\n" +
	//                 "cmllcywgTExDMRswGQYDVQQLDBJRWiBJbmR1c3RyaWVzLCBMTEMxGTAXBgNVBAMM\n" +
	//                 "EHF6aW5kdXN0cmllcy5jb20xJzAlBgkqhkiG9w0BCQEWGHN1cHBvcnRAcXppbmR1\n" +
	//                 "c3RyaWVzLmNvbTCCAiIwDQYJKoZIhvcNAQEBBQADggIPADCCAgoCggIBANTDgNLU\n" +
	//                 "iohl/rQoZ2bTMHVEk1mA020LYhgfWjO0+GsLlbg5SvWVFWkv4ZgffuVRXLHrwz1H\n" +
	//                 "YpMyo+Zh8ksJF9ssJWCwQGO5ciM6dmoryyB0VZHGY1blewdMuxieXP7Kr6XD3GRM\n" +
	//                 "GAhEwTxjUzI3ksuRunX4IcnRXKYkg5pjs4nLEhXtIZWDLiXPUsyUAEq1U1qdL1AH\n" +
	//                 "EtdK/L3zLATnhPB6ZiM+HzNG4aAPynSA38fpeeZ4R0tINMpFThwNgGUsxYKsP9kh\n" +
	//                 "0gxGl8YHL6ZzC7BC8FXIB/0Wteng0+XLAVto56Pyxt7BdxtNVuVNNXgkCi9tMqVX\n" +
	//                 "xOk3oIvODDt0UoQUZ/umUuoMuOLekYUpZVk4utCqXXlB4mVfS5/zWB6nVxFX8Io1\n" +
	//                 "9FOiDLTwZVtBmzmeikzb6o1QLp9F2TAvlf8+DIGDOo0DpPQUtOUyLPCh5hBaDGFE\n" +
	//                 "ZhE56qPCBiQIc4T2klWX/80C5NZnd/tJNxjyUyk7bjdDzhzT10CGRAsqxAnsjvMD\n" +
	//                 "2KcMf3oXN4PNgyfpbfq2ipxJ1u777Gpbzyf0xoKwH9FYigmqfRH2N2pEdiYawKrX\n" +
	//                 "6pyXzGM4cvQ5X1Yxf2x/+xdTLdVaLnZgwrdqwFYmDejGAldXlYDl3jbBHVM1v+uY\n" +
	//                 "5ItGTjk+3vLrxmvGy5XFVG+8fF/xaVfo5TW5AgMBAAGjUDBOMB0GA1UdDgQWBBSQ\n" +
	//                 "plC3hNS56l/yBYQTeEXoqXVUXDAfBgNVHSMEGDAWgBQDRcZNwPqOqQvagw9BpW0S\n" +
	//                 "BkOpXjAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBCwUAA4IBAQAJIO8SiNr9jpLQ\n" +
	//                 "eUsFUmbueoxyI5L+P5eV92ceVOJ2tAlBA13vzF1NWlpSlrMmQcVUE/K4D01qtr0k\n" +
	//                 "gDs6LUHvj2XXLpyEogitbBgipkQpwCTJVfC9bWYBwEotC7Y8mVjjEV7uXAT71GKT\n" +
	//                 "x8XlB9maf+BTZGgyoulA5pTYJ++7s/xX9gzSWCa+eXGcjguBtYYXaAjjAqFGRAvu\n" +
	//                 "pz1yrDWcA6H94HeErJKUXBakS0Jm/V33JDuVXY+aZ8EQi2kV82aZbNdXll/R6iGw\n" +
	//                 "2ur4rDErnHsiphBgZB71C5FD4cdfSONTsYxmPmyUb5T+KLUouxZ9B0Wh28ucc1Lp\n" +
	//                 "rbO7BnjW\n" +
	//                 "-----END CERTIFICATE-----\n");
});

qz.security.setSignatureAlgorithm("SHA512"); // Since 2.1
qz.security.setSignaturePromise(function (toSign) {
	return function (resolve, reject) {
		//Preferred method - from server
		//            fetch("/secure/url/for/sign-message?request=" + toSign, {cache: 'no-store', headers: {'Content-Type': 'text/plain'}})
		//              .then(function(data) { data.ok ? resolve(data.text()) : reject(data.text()); });
		$.post("<?= base_url('assets/signing/sign-message.php') ?>", {
			request: toSign,
		}).then(resolve, reject);
		//Alternate method - unsigned
		resolve(); // remove this line in live environment
	};
});
