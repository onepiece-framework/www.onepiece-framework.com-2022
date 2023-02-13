
 ## op-app-skeleton-2020-nep:/asset/git/submodule/init.sh
 #
 # @created    ????
 # @version    1.0
 # @package    op-app-skeleton-2020-nep
 # @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 # @copyright  Tomoaki Nagahara All right reserved.
 #

# branch name
BRANCH=${1}

# Check branch name.
if [ -z "$BRANCH" ]; then
  echo 'Empty branch name. --> sh asset/git/submodule/init.sh 2022'
  exit 1
fi

# Init git submodule
# git submodule init
# git submodule update
git submodule update --init --recursive
git submodule foreach git checkout $BRANCH
