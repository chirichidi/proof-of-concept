docker run \
  --rm \
  --network host \
  -v /data/app/proof-of-concept/php/logger:/opt/project \
  chirichidi/proof-of-concept-php8-jit-runtime php /opt/project/bin/test_stress.php