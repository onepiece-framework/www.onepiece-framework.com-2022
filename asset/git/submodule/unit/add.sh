
# branch name
UNIT=${1}
BRANCH=${2:-2022}
URL=https://github.com/onepiece-framework/op-unit-$UNIT.git
PATH=asset/unit/$UNIT

# Validation
if [ -z "$UNIT" ]; then
  echo 'Empty unit name. --> sh asset/git/submodule/unit/add.sh {unit_name}'
  exit 1
fi

# Add git submodule
#`git submodule add      $URL $PATH`
echo "git submodule add -b $BRANCH $URL $PATH"
#echo "git submodule init     $PATH"
#echo "git submodule update   $PATH"
#echo "git submodule checkout $BRANCH"
