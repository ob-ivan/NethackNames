#!/bin/bash

function generate_gender {
    case $(date +%N | tail -c2 | head -c1) in
        0|2|4|6|8) echo male
        1|3|5|7|9) echo female
    esac
}

DIR=/var/games/nethack/save
SAVE_COUNT=$(ls -1 $DIR | wc -l)
SAVES=$(ls $DIR | sed -E 's/1000(.*).gz/\1/')

if [ $SAVE_COUNT -eq 1 ]; then
    NAME=$SAVES
else
    if [[ -z $SAVES ]]; then
        GENDER=$(generate_gender)
        NAME=$(php nethack-names.php gender=$GENDER)
        export NETHACKOPTIONS="gender=$GENDER, catname:$(php nethack-names.php), dogname:$(php nethack-names.php), horsename:$(php nethack-names.php)"
    else
        echo 'Available names: ' $SAVES
        read -p 'Who are you? ' NAME
    fi
fi

nethack -u $NAME
