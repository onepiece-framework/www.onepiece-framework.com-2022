
 ## op-app-skeleton-2020-nep:/asset/git/submodule/repo.sh
 #
 # @created    ????
 # @version    1.0
 # @package    op-app-skeleton-2020-nep
 # @author     Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 # @copyright  Tomoaki Nagahara All right reserved.
 #

# First, Change to local path.
sh asset/git/submodule/local.sh

# --> sudo port install realpath
HOME=$(realpath ~/)

# Change to remote path from local path.
sed -i -e "s|${HOME}/repo/|repo:~/repo/|g" .gitmodules

# Sync
git submodule sync
