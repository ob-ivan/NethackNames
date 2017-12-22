#!/bin/bash
DIR=/var/games/nethack/save
SAVE_COUNT=$(ls -1 $DIR | wc -l)
SAVES=$(ls $DIR | sed -E 's/1000(.*).gz/\1/')

if [ $SAVE_COUNT -eq 1 ]; then
    NAME=$SAVES
else
    if [[ -z $SAVES ]]; then
        NAME=$(php nethack-names.php)
        export NETHACKOPTIONS="catname:$(php nethack-names.php), dogname:$(php nethack-names.php), horsename:$(php nethack-names.php)"
    else
        echo 'Available names: ' $SAVES
        read -p 'Who are you? ' NAME
    fi
fi

nethack -u $NAME
