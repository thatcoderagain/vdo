# Run the command to regenerate protobuf files
# In order to execute this command system requires PHP install along with dev dependencies
php ./vendor/bin/protobuf --include-descriptors -i ./src/vdocipher -o ./src/Vdocipher ./src/vdocipher/Token.proto