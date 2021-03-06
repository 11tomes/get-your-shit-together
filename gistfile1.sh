#!/bin/sh

git filter-branch --env-filter '

an="$GIT_AUTHOR_NAME"
am="$GIT_AUTHOR_EMAIL"
cn="$GIT_COMMITTER_NAME"
cm="$GIT_COMMITTER_EMAIL"

if [ "$GIT_COMMITTER_EMAIL" = "dixie.atay@gmail.com" ]
then
    cn="Leonel L. Tomes"
    cm="mr.leonel.tomes@gmail.com"
fi
if [ "$GIT_AUTHOR_EMAIL" = "dixie.atay@gmail.com" ]
then
    an="Leonel L. Tomes"
    am="mr.leonel.tomes@gmail.com"
fi

export GIT_AUTHOR_NAME="$an"
export GIT_AUTHOR_EMAIL="$am"
export GIT_COMMITTER_NAME="$cn"
export GIT_COMMITTER_EMAIL="$cm"
'
