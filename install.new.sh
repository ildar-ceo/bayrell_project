#!/bin/bash


./compiler/cli.js make core_build nodejs
./compiler/cli.js make lang_build nodejs
./compiler/cli.js make Runtime nodejs

npm install $(npm pack ./lib/Runtime/nodejs | tail -1)
npm install $(npm pack ./lib/core_build/nodejs | tail -1)
npm install $(npm pack ./lib/lang_build/nodejs | tail -1)


mv *.tgz tmp
