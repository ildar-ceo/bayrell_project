#!/bin/bash


./compiler/cli.js make core_build nodejs
./compiler/cli.js make lang_build nodejs
./compiler/cli.js make Runtime nodejs

./compiler/cli.js make core_build php
./compiler/cli.js make lang_build php
./compiler/cli.js make Runtime php

./compiler/cli.js make core_build es6
./compiler/cli.js make lang_build es6
./compiler/cli.js make Runtime es6
