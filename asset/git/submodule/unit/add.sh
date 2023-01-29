
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
git submodule add      $URL $PATH
git submodule init
git submodule update
git submodule checkout $BRANCH
